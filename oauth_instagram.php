<?php
class modules_oauth_instagram {
    public function __construct() {
        $app = Dataface_Application::getInstance();
        $app->registerEventListener('oauth_fetch_user_data', array($this, 'oauth_fetch_user_data'), false);
        $app->registerEventListener('oauth_extract_user_properties_from_user_data', array($this, 'oauth_extract_user_properties_from_user_data'), false);
    }
    
    
    public function oauth_fetch_user_data($evt) {
        if ($evt->service !== 'instagram') {
            return;
        }
        
         /*
         * "user": {
            "id": "1574083",
            "username": "snoopdogg",
            "full_name": "Snoop Dogg",
            "profile_picture": "..."
        }
         */
        $data = $_SESSION['instagram_access_token_response'];
        
        
        $evt->out = $data['user'];
        return;
        
    }
    
    public function oauth_extract_user_properties_from_user_data($evt) {
        if ($evt->service !== 'instagram') {
            return;
        }
        
        $evt->out = array(
            'id' => $evt->userData['id'], 
            'name' => $evt->userData['full_name'], 
            'username' => $evt->userData['username'],
            'profile_picture' => $evt->userData['profile_picture']
        );
    }
    
            
}

