/**
 * Copyright [2015] [Codelyst (Prashant goyal)]
 * <p/>
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * <p/>
 * http://www.apache.org/licenses/LICENSE-2.0
 * <p/>
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.se.
 */

package com.codelyst.ccm.utils;

import android.content.Context;
import android.content.pm.ApplicationInfo;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.util.Log;

/**
 * Created by Prashant on 18-07-2015.
 */
public class Utils {

    public static String getMetaDataFromManifests(Context activity,String meta_data_key) {

        try {
            ApplicationInfo ai = activity.getPackageManager().
                    getApplicationInfo(activity.getPackageName(), PackageManager.GET_META_DATA);
            Bundle bundle = ai.metaData;
            String metaDataValue = bundle.getString(meta_data_key);
            return metaDataValue;
        } catch (PackageManager.NameNotFoundException e) {
            Log.e("Utils", "Failed to load meta-data, NameNotFound: " + e.getMessage());
        } catch (NullPointerException e) {
            Log.e("Utils", "Failed to load meta-data, NullPointer: " + e.getMessage());
        }

        return null;
    }
}
