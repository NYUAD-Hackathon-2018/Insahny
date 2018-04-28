
package com.microsoft.projectoxford.nyuadhack.contract;

import java.util.ArrayList;
import java.util.List;
import java.util.UUID;

public class IdentifyResult {
    public UUID faceId;

    public List<Candidate> candidates = new ArrayList<>();
}
