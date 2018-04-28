
package com.microsoft.projectoxford.nyuadhack.contract;

import com.google.gson.annotations.SerializedName;

/**
 * Accessory class contains accessory information
 */
public class Accessory {
    /**
     * Accessory types
     */
    public enum AccessoryType {
        @SerializedName("headwear")
        Headwear,
        @SerializedName("glasses")
        Glasses,
        @SerializedName("mask")
        Mask
    }

    /**
     * Indicating the accessory type
     */
    public AccessoryType type;

    /**
     * Indicating the confidence for accessory type
     */
    public double confidence;
}
