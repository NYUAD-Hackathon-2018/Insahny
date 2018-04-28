//
//  ScanQRViewController.swift
//  Itreat Business
//
//  Created by Rahul KR on 4/8/18.
//  Copyright © 2018 Itreat Advertising. All rights reserved.
//

import UIKit
import AVFoundation
import Alamofire

class ScanQRViewController: UIViewController,AVCaptureMetadataOutputObjectsDelegate {
    var qrSeen = Set<String>()
    
    override func viewDidLoad() {
        super.viewDidLoad()
        var video = AVCaptureVideoPreviewLayer()
        let session = AVCaptureSession()
        let captureDevice = AVCaptureDevice.default(for: .video)
        do{
            let input = try AVCaptureDeviceInput(device: captureDevice!)
            session.addInput(input)
        }
        catch{
            print("error")
            
        }
        let output = AVCaptureMetadataOutput()
        session.addOutput(output)
        //output.setMetadataObjectTypes = [AVMetadataObjectTypeQRCode]
        output.setMetadataObjectsDelegate(self, queue: DispatchQueue.main)
        output.metadataObjectTypes = [.qr]
        
        video = AVCaptureVideoPreviewLayer(session: session)
        video.frame = CGRect(x:0, y:10 , width:400, height: 450)
        view.layer.addSublayer(video)
        
        session.startRunning()
        //self.view.bringSubview(toFront: myImageView)
        // Do any additional setup after loading the view.
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    func metadataOutput(_ output: AVCaptureMetadataOutput, didOutput metadataObjects: [AVMetadataObject], from connection: AVCaptureConnection) {
        
        print("--------")
        for object in metadataObjects {
            if let readableObject = object as? AVMetadataMachineReadableCodeObject,
                let value = readableObject.stringValue {
                print(value)
                qrSeen.insert(value)
            }
        }
        print("--------")
        print(qrSeen)
    }
    
    
    @IBAction func sendQR(_ sender: Any) {
        let results =  ["qrs": Array(qrSeen) ]
        guard let resultsData = try? JSONEncoder().encode(results) else {
            return
        }
        guard let resultsString = String(data: resultsData, encoding: .utf8) else {
            return
        }
        let qr: Parameters = [
            "qr": resultsString
        ]
        
        Alamofire.request("https://pitchkings.net/hackathon/driver.php", method: .post, parameters: qr).responseJSON { response in
            
            
            print("Request: \(String(describing: response.request))")   // original url request
            print("Response: \(String(describing: response.response))") // http url response
            print("Result: \(response.result)")                         // response serialization result
            
            if let json = response.result.value {
                print("JSON: \(json)") // serialized json response
            }
            
            if let data = response.data, let utf8Text = String(data: data, encoding: .utf8) {
                print("Data: \(utf8Text)") // original server data as UTF8 string
            }
        }
    }
    func found(code: String) {
        print(code)
    }
    
    override var prefersStatusBarHidden: Bool {
        return true
    }
    
    override var supportedInterfaceOrientations: UIInterfaceOrientationMask {
        return .portrait
    }
}

