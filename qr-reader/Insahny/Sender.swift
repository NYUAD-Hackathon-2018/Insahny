//
//  Sender.swift
//  Insahny
//
//  Created by Nnamdi Ugwuoke on 4/28/18.
//  Copyright © 2018 Insahny. All rights reserved.
//

import Foundation

public class Sender {
    var url = "https://pitchkings.net/hackathon/driver.php"
    var postVariable = "qr"
    
    struct PostRequest: Codable {
        var qr: [String]
    }
    
    public init() {
        
    }
    
    public func send(results: [String]) {
        
        guard let serviceUrl = URL(string: url) else { return }
        guard let data = convert(postRequest: PostRequest(qr: results)) else { return }

        var request = URLRequest(url: serviceUrl)
        request.httpMethod = "POST"
        request.setValue("Application/json", forHTTPHeaderField: "Content-Type")
        request.httpBody = data
        
        let session = URLSession.shared
        session.dataTask(with: request) { (data, response, error) in
            if let response = response {
                print(response)
            }
            if let data = data {
                do {
                    let json = try JSONSerialization.jsonObject(with: data, options: [])
                    print(json)
                }catch {
                    print(error)
                }
            }
            }.resume()
    }
    
    func convert(postRequest: PostRequest) -> Data? {
        let encoder = JSONEncoder()
        guard let data = try? encoder.encode(postRequest) else {
            return nil
        }
        return data
    }
}



