## Security Policy

This component adds configurable headers and a nonce value for inline content.

Nonce value can get accessed via the page global $StoredNonce. Useful for all inline scripts.

Add the value in templates if you have inline javascript

    <script type="application/javascript" nonce="$StoredNonce">

You can also create CSP and general site headers using this module. No headers are provided by default.

Just create a yml config like the following:

**app/_config/SecurityPolicy.yml**

~~~yaml
    Pikselin\base\SecurityPolicyController:
    #  use_nonce: false
    #  csp_type: Content-Security-Policy
    #  csp_type: false /* setting to false disables CSP header inclusion but won't disable standard headers*/
    #  possible options [Content-Security-Policy, Content-Security-Policy-Report-Only, false]
    #  https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy
      headers:
        X-Frame-Options: SAMEORIGIN
        Referrer-Policy: same-origin
        X-Content-Type-Options: nosniff
        Permissions-Policy: "camera=(), cross-origin-isolated=*, fullscreen=(*)"
        Strict-Transport-Security: "max-age=31536000; includeSubDomains"
        X-Powered-By: "xxx"
        Access-Control-Allow-Origin: "*"
      csp_headers:
        default-src:
          - "'self'"
          - "data:"
          - unsafe-inline
          - unsafe-eval      
          - '*.googleapis.com'
          - '*.hotjar.com'
          - '*.youtube.com'
          - 'googleads.g.doubleclick.net'
          - '*.monsido.com'
        script-src:
          - "'self'"
          - "data:"
          - unsafe-inline
          - unsafe-eval    
~~~

[Information on how to generate CSP headers](https://report-uri.com/home/generate)
