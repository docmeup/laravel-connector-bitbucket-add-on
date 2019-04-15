Learn more about [Integrating with Bitbucket Cloud](https://developer.atlassian.com/cloud/bitbucket/integrating-with-bitbucket-cloud/).

# Install

1. Get package via composer: `composer require docmeup/laravel-connector-bitbucket`
1. Initialize default config and routes: `artisan vendor:publish --tag docmeup-connector-bitbucket`

# Confirm Routes

You should have a new route file that manages request to `/connector` at `./routes/connector.php`

`artisan route:list` should return:

```
GET|HEAD | connector/bitbucket/atlassian-connect.json
POST     | connector/bitbucket/installed
POST     | connector/bitbucket/uninstalled
```

> {tip} Your Bitbucket "describe URI" should be accessible:
>
> `https://{APP_URL}/connector/bitbucket/atlassian-connect.json`

> {tip} Bitbucket will post their app secret to the `installed` endpoint. Your app should store this to authenticate Bitbucket requests using JWT authentication.

# Confirm Config

A new file should be available at `./config/gitconnector.php`.

`config('gitconnector.bitbucket.connector')` determines the output of `connector/bitbucket/atlassian-connect.json` by default. You can assign new logic in `./routes/connector.php`.

# Noteworthy

**X-Frame-Options**

The default config instructs Bitbucket to make cross-origin request to your Laravel website. The `X-Frame-Options` header needs to be set accordingly. A value of `ALLOWALL` on the `connector/bitbucket` route will help you debug most quickly.

# Testing

1. Expose your project to the web using a service such as Ngrok or LocalTunnel.me
1. Add the add-on to your account:
   - Click "Create App" at `https://bitbucket.org/account/user/{YOUR_USER}/applications`
   - Provide the describe URI: `https://{NGROK_HOST}/connector/bitbucket/atlassian-connect.json`
1. Bitbucket will provide you with a cliend ID and secret. Update your `.env`
   - ```env
     # NGROK or LocalTunnel.me host. Example: https://smooth-host-1234.localtunnel.me
     GITCONNECTOR_BITBUCKET_HOST=
     GITCONNECTOR_BITBUCKET_CLIENT_ID=
     GITCONNECTOR_BITBUCKET_CLIENT_SECRET=
     ```
1. Click "Install app from URL" at `https://bitbucket.org/account/user/{YOUR_USER}/addon-management`
1. Provide the describe URI: `https://{NGROK_HOST}/connector/bitbucket/atlassian-connect.json`

**What You Should See in Bitbucket**

- Visit one of your repositories. "Example Page YAS" and "Example Web Item" will be visible in the left-hand navigation menu.
- Visit your repository Source page. You should see "Loading add-on Demo Laravel Add-on"
