//
//  ViewController.swift
//  Insahny
//
//  Created by Nnamdi Ugwuoke on 4/28/18.
//  Copyright © 2018 Insahny. All rights reserved.
//

import UIKit
import Alamofire

class ViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    @IBAction func didTapSend(_ sender: Any) {
        
        let qr: Parameters = [
            "qr": [
                "1-A",
                "2-A",
                "3-B",
                "4-C"
            ]
            
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
    
}

