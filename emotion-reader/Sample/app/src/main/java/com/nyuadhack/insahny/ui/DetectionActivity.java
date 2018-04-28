
package com.nyuadhack.insahny.ui;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.v7.app.AppCompatActivity;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import com.google.gson.Gson;
import com.google.gson.JsonArray;
import com.google.gson.JsonElement;
import com.google.gson.reflect.TypeToken;
import com.microsoft.projectoxford.face.FaceServiceClient;
import com.microsoft.projectoxford.face.contract.Face;
import com.nyuadhack.insahny.helper.ImageHelper;
import com.nyuadhack.insahny.helper.LogHelper;
import com.nyuadhack.insahny.helper.SampleApp;
import com.nyuadhack.insahny.log.DetectionLogActivity;

import java.io.BufferedOutputStream;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import javax.net.ssl.HttpsURLConnection;

public class DetectionActivity extends AppCompatActivity {
    // Background task of face detection.
    private class DetectionTask extends AsyncTask<InputStream, String, Face[]> {
        private boolean mSucceed = true;

        @Override
        protected Face[] doInBackground(InputStream... params) {
            // Get an instance of face service client to detect faces in image.
            FaceServiceClient faceServiceClient = SampleApp.getFaceServiceClient();
            try {
                publishProgress("Detecting...");

                // Start detection.
                return faceServiceClient.detect(
                        params[0],  /* Input stream of image to detect */
                        true,       /* Whether to return face ID */
                        true,       /* Whether to return face landmarks */
                        /* Which face attributes to analyze, currently we support:
                           age,gender,headPose,smile,facialHair */
                        new FaceServiceClient.FaceAttributeType[] {
                                FaceServiceClient.FaceAttributeType.Emotion
                        });
            } catch (Exception e) {
                mSucceed = false;
                publishProgress(e.getMessage());
                addLog(e.getMessage());
                return null;
            }
        }

        @Override
        protected void onPreExecute() {
            mProgressDialog.show();
            addLog("Request: Detecting in image " + mImageUri);
        }

        @Override
        protected void onProgressUpdate(String... progress) {
            mProgressDialog.setMessage(progress[0]);
            setInfo(progress[0]);
        }

        @Override
        protected void onPostExecute(Face[] result) {
            if (mSucceed) {
                addLog("Response: Success. Detected " + (result == null ? 0 : result.length)
                        + " face(s) in " + mImageUri);
            }

            // Show the result on screen when detection is done.
            try {
                setUiAfterDetection(result, mSucceed);
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }

    // Flag to indicate which task is to be performed.
    private static final int REQUEST_SELECT_IMAGE = 0;

    // The URI of the image selected to detect.
    private Uri mImageUri;

    // The image selected to detect.
    private Bitmap mBitmap;

    // Progress dialog popped up when communicating with server.
    ProgressDialog mProgressDialog;

    // When the activity is created, set all the member variables to initial state.
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(com.nyuadhack.insahny.R.layout.activity_detection);

        mProgressDialog = new ProgressDialog(this);
        mProgressDialog.setTitle(getString(com.nyuadhack.insahny.R.string.progress_dialog_title));

        // Disable button "detect" as the image to detect is not selected.
        setDetectButtonEnabledStatus(false);

        LogHelper.clearDetectionLog();
    }

    // Save the activity state when it's going to stop.
    @Override
    protected void onSaveInstanceState(Bundle outState) {
        super.onSaveInstanceState(outState);

        outState.putParcelable("ImageUri", mImageUri);
    }

    // Recover the saved state when the activity is recreated.
    @Override
    protected void onRestoreInstanceState(@NonNull Bundle savedInstanceState) {
        super.onRestoreInstanceState(savedInstanceState);

        mImageUri = savedInstanceState.getParcelable("ImageUri");
        if (mImageUri != null) {
            mBitmap = ImageHelper.loadSizeLimitedBitmapFromUri(
                    mImageUri, getContentResolver());
        }
    }

    // Called when image selection is done.
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        switch (requestCode) {
            case REQUEST_SELECT_IMAGE:
                if (resultCode == RESULT_OK) {
                    // If image is selected successfully, set the image URI and bitmap.
                    mImageUri = data.getData();
                    mBitmap = ImageHelper.loadSizeLimitedBitmapFromUri(
                            mImageUri, getContentResolver());
                    if (mBitmap != null) {
                        // Show the image on screen.
                        ImageView imageView = (ImageView) findViewById(com.nyuadhack.insahny.R.id.image);
                        imageView.setImageBitmap(mBitmap);

                        // Add detection log.
                        addLog("Image: " + mImageUri + " resized to " + mBitmap.getWidth()
                                + "x" + mBitmap.getHeight());
                    }

                    // Clear the detection result.
                    FaceListAdapter faceListAdapter = new FaceListAdapter(null);
                    ListView listView = (ListView) findViewById(com.nyuadhack.insahny.R.id.list_detected_faces);
                    listView.setAdapter(faceListAdapter);

                    // Clear the information panel.
                    setInfo("");

                    // Enable button "detect" as the image is selected and not detected.
                    setDetectButtonEnabledStatus(true);
                }
                break;
            default:
                break;
        }
    }

    // Called when the "Select Image" button is clicked.
    public void selectImage(View view) {
        Intent intent = new Intent(this, SelectImageActivity.class);
        startActivityForResult(intent, REQUEST_SELECT_IMAGE);
    }

    // Called when the "Detect" button is clicked.
    public void detect(View view) {
        // Put the image into an input stream for detection.
        ByteArrayOutputStream output = new ByteArrayOutputStream();
        mBitmap.compress(Bitmap.CompressFormat.JPEG, 100, output);
        ByteArrayInputStream inputStream = new ByteArrayInputStream(output.toByteArray());

        // Start a background task to detect faces in the image.
        new DetectionTask().execute(inputStream);

        // Prevent button click during detecting.
        setAllButtonsEnabledStatus(false);
    }

    // View the log of service calls.
    public void viewLog(View view) {
        Intent intent = new Intent(this, DetectionLogActivity.class);
        startActivity(intent);
    }

    // Show the result on screen when detection is done.
    private void setUiAfterDetection(Face[] result, boolean succeed) throws IOException {

        // Detection is done, hide the progress dialog.
        mProgressDialog.dismiss();

        // Enable all the buttons.
        setAllButtonsEnabledStatus(true);

        // Disable button "detect" as the image has already been detected.
        setDetectButtonEnabledStatus(false);

        if (succeed) {
            // The information about the detection result.
            String detectionResult;
            if (result != null) {
                detectionResult = result.length + " face"
                        + (result.length != 1 ? "s" : "") + " detected";

                // Show the detected faces on original image.
                ImageView imageView = (ImageView) findViewById(com.nyuadhack.insahny.R.id.image);
                imageView.setImageBitmap(ImageHelper.drawFaceRectanglesOnBitmap(
                        mBitmap, result, true));

                // Set the adapter of the ListView which contains the details of the detected faces.
                    FaceListAdapter faceListAdapter = new FaceListAdapter(result);

                // Show the detailed list of detected faces.
                ListView listView = (ListView) findViewById(com.nyuadhack.insahny.R.id.list_detected_faces);
                listView.setAdapter(faceListAdapter);

                List<Face> faces = Arrays.asList(result);
                ArrayList<String> emotions = new ArrayList<>();
                for (Face face : faces) {
                    emotions.add(faceListAdapter.getEmotion(face.faceAttributes.emotion));
                }

                Gson gson = new Gson();
                JsonElement element = gson.toJsonTree(emotions, new TypeToken<List<String>>() {}.getType());

                if (! element.isJsonArray()) {
                    Log.d("you are aweaome", "you are aweaome");
                }
                JsonArray jsonArray = element.getAsJsonArray();
                new CallAPI().execute("http://pitchkings.net/hackathon/sendEmotion.php/", "emotion=" + "{results:" + jsonArray.toString() + "}");
            } else {
                detectionResult = "0 face detected";
            }
            setInfo(detectionResult);
        }

        mImageUri = null;
        mBitmap = null;
    }

    // Set whether the buttons are enabled.
    private void setDetectButtonEnabledStatus(boolean isEnabled) {
        Button detectButton = (Button) findViewById(com.nyuadhack.insahny.R.id.detect);
        detectButton.setEnabled(isEnabled);
    }

    // Set whether the buttons are enabled.
    private void setAllButtonsEnabledStatus(boolean isEnabled) {
        Button selectImageButton = (Button) findViewById(com.nyuadhack.insahny.R.id.select_image);
        selectImageButton.setEnabled(isEnabled);

        Button detectButton = (Button) findViewById(com.nyuadhack.insahny.R.id.detect);
        detectButton.setEnabled(isEnabled);

        Button ViewLogButton = (Button) findViewById(com.nyuadhack.insahny.R.id.view_log);
        ViewLogButton.setEnabled(isEnabled);
    }

    // Set the information panel on screen.
    private void setInfo(String info) {
        TextView textView = (TextView) findViewById(com.nyuadhack.insahny.R.id.info);
        textView.setText(info);
    }

    // Add a log item.
    private void addLog(String log) {
        LogHelper.addDetectionLog(log);
    }

    // The adapter of the GridView which contains the details of the detected faces.
    private class FaceListAdapter extends BaseAdapter {
        // The detected faces.
        List<Face> faces;

        // The thumbnails of detected faces.
        List<Bitmap> faceThumbnails;

        // Initialize with detection result.
        FaceListAdapter(Face[] detectionResult) {
            faces = new ArrayList<>();
            faceThumbnails = new ArrayList<>();

            if (detectionResult != null) {
                faces = Arrays.asList(detectionResult);
                for (Face face : faces) {
                    try {
                        // Crop face thumbnail with five main landmarks drawn from original image.
                        faceThumbnails.add(ImageHelper.generateFaceThumbnail(
                                mBitmap, face.faceRectangle));
                    } catch (IOException e) {
                        // Show the exception when generating face thumbnail fails.
                        setInfo(e.getMessage());
                    }
                }
            }
        }

        @Override
        public boolean isEnabled(int position) {
            return false;
        }

        @Override
        public int getCount() {
            return faces.size();
        }

        @Override
        public Object getItem(int position) {
            return faces.get(position);
        }

        @Override
        public long getItemId(int position) {
            return position;
        }

        @Override
        public View getView(final int position, View convertView, ViewGroup parent) {
            if (convertView == null) {
                LayoutInflater layoutInflater =
                        (LayoutInflater) getSystemService(Context.LAYOUT_INFLATER_SERVICE);
                convertView = layoutInflater.inflate(com.nyuadhack.insahny.R.layout.item_face_with_description, parent, false);
            }
            convertView.setId(position);

            // Show the face thumbnail.
            ((ImageView) convertView.findViewById(com.nyuadhack.insahny.R.id.face_thumbnail)).setImageBitmap(
                    faceThumbnails.get(position));

            // Show the face details.
            DecimalFormat formatter = new DecimalFormat("#0.0");
            String face_description = String.format("%s", getEmotion(faces.get(position).faceAttributes.emotion));
            ((TextView) convertView.findViewById(com.nyuadhack.insahny.R.id.text_detected_face)).setText(face_description);

            return convertView;
        }

        private String getEmotion(com.microsoft.projectoxford.face.contract.Emotion emotion)
        {
            String emotionType = "";
            double emotionValue = 0.0;
            if (emotion.anger > emotionValue)
            {
                emotionType = "20";
            }
            if (emotion.contempt > emotionValue)
            {
                emotionType = "100";
            }
            if (emotion.disgust > emotionValue)
            {
                emotionType = "20";
            }
            if (emotion.fear > emotionValue)
            {
                emotionType = "40";
            }
            if (emotion.happiness > emotionValue)
            {
                emotionType = "100";
            }
            if (emotion.neutral > emotionValue)
            {
                emotionType = "80";
            }
            if (emotion.sadness > emotionValue)
            {
                emotionType = "60";
            }
            if (emotion.surprise > emotionValue)
            {
                emotionType = "80";
            }
//            return String.format("%s: %f", emotionType, emotionValue);
            return String.format("%s", emotionType);
        }
    }

    public class CallAPI extends AsyncTask<String, String, String> {

        public CallAPI(){
            //set context variables if required
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }


        @Override
        protected String doInBackground(String... params) {

            String urlString = params[0]; // URL to call

            String data = params[1]; //data to post

            OutputStream out = null;
            String response="";
            try {

                URL url = new URL(urlString);

                HttpURLConnection urlConnection = (HttpURLConnection) url.openConnection();

                urlConnection.setRequestMethod("POST");

                out = new BufferedOutputStream(urlConnection.getOutputStream());

                BufferedWriter writer = new BufferedWriter (new OutputStreamWriter(out, "UTF-8"));

                writer.write(data);

                writer.flush();

                writer.close();

                out.close();
                int responseCode=urlConnection.getResponseCode();


                if (responseCode == HttpsURLConnection.HTTP_OK) {
                    String line;
                    BufferedReader br=new BufferedReader(new InputStreamReader(urlConnection.getInputStream()));
                    while ((line=br.readLine()) != null) {
                        response+=line;
                    }
                }




            } catch (Exception e) {

                System.out.println(e.getMessage());



            }

            return urlString;
        }
    }
}
