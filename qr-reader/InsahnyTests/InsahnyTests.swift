//
//  InsahnyTests.swift
//  InsahnyTests
//
//  Created by Nnamdi Ugwuoke on 4/28/18.
//  Copyright © 2018 Insahny. All rights reserved.
//

import XCTest
@testable import Insahny

class InsahnyTests: XCTestCase {
    
    override func setUp() {
        super.setUp()
        // Put setup code here. This method is called before the invocation of each test method in the class.
    }
    
    override func tearDown() {
        // Put teardown code here. This method is called after the invocation of each test method in the class.
        super.tearDown()
    }
    
    func testPost() {
        let sender = Sender()
        sender.send(results: ["a","b", "c"])
        RunLoop.main.run(until: Date().addingTimeInterval(2))
        print("done")
    }
    
    
}
