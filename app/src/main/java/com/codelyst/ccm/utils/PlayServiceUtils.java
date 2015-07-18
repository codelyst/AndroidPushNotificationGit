package com.codelyst.ccm.utils;

import android.support.v7.app.AppCompatActivity;
import android.util.Log;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GooglePlayServicesUtil;

/**
 * Created by Prashant Goyal on 18-07-2015.
 */
public class PlayServiceUtils {

    private static final int PLAY_SERVICES_RESOLUTION_REQUEST = 9000;


    public static boolean checkPlayServices(AppCompatActivity appCompatActivity) {
        int resultCode = GooglePlayServicesUtil.isGooglePlayServicesAvailable(appCompatActivity);
        if (resultCode != ConnectionResult.SUCCESS) {
            if (GooglePlayServicesUtil.isUserRecoverableError(resultCode)) {
                GooglePlayServicesUtil.getErrorDialog(resultCode, appCompatActivity,
                        PLAY_SERVICES_RESOLUTION_REQUEST).show();
            } else {
                Log.i(appCompatActivity.getClass().getName(), "This device is not supported.");

            }
            return false;
        }
        return true;
    }
}
