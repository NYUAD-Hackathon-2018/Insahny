
package com.microsoft.projectoxford.nyuadhack.rest;

import org.apache.http.client.methods.HttpPost;

public class HttpPatch extends HttpPost {
    private static final String METHOD_PATCH = "PATCH";

    public HttpPatch(final String url) {
        super(url);
    }

    @Override
    public String getMethod() {
        return METHOD_PATCH;
    }
}
