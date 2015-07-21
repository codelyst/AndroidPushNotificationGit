/**
 * Copyright [2015] [Codelyst (Prashant goyal)]
 * <p></p>
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * <p></p>
 * http://www.apache.org/licenses/LICENSE-2.0
 *<p></p>
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.se.
 */


///
// A service that extends InstanceIDListenerService,
// to handle the creation, rotation, and updating of
// registration tokens.
// <service
//     android:name="com.codelyst.ccm.AppInstanceIDListenerService"
//     android:exported="false">
//      <intent-filter>
//          <action android:name="com.google.android.gms.iid.InstanceID"/>
//       </intent-filter>
//   </service>
//
//

package com.codelyst.ccm;

import android.content.Intent;

import com.google.android.gms.iid.InstanceIDListenerService;



public class AppInstanceIDListenerService extends InstanceIDListenerService {

    private static final String TAG = "MyInstanceIDLS";

    /**
     * Called if InstanceID token is updated. This may occur if the security of
     * the previous token had been compromised. This call is initiated by the
     * InstanceID provider.
     */
    // [START refresh_token]
    @Override
    public void onTokenRefresh() {
        // Fetch updated Instance ID token and notify our app's server of any changes (if applicable).
        Intent intent = new Intent(this, RegistrationIntentService.class);
        startService(intent);
    }
    // [END refresh_token]


}
