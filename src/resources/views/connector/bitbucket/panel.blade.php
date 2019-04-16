<!doctype html>
<html lang="en">
<head>
    <title>Bitbucket Web Panel</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@atlaskit/css-reset@3.0.8/dist/bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@atlaskit/reduced-ui-pack@10.5.6/dist/bundle.min.css"/>
</head>

<body>
<h1>{{config('gitconnector.bitbucket.connector.name')}}</h1>

<p>Try installing <code>yarn add @atlaskit/reduced-ui-pack</code> or continue to use the CDN within the header.</p>
{{--
/**
 * ::START:: Bitbucket-Required JS
 *
 * Content will not render without this set of code.
 */
--}}
<script src="//aui-cdn.atlassian.com/aui-adg/6.0.9/js/aui.min.js" data-options="sizeToParent: true"></script>
<script id="connect-loader" data-options="sizeToParent:true;"></script>
<script>
  function getUrlParam (p) {
    var m = (new RegExp(p + '=([^&]*)')).exec(window.location.search)
    return m ? decodeURIComponent(m[1]) : ''
  }

  var s = document.createElement('script')
  var b = getUrlParam('xdm_e') + getUrlParam('cp')
  s.src = b + '/atlassian-connect/all.js'
  s.async = false
  s.setAttribute('data-options', document.getElementById('connect-loader').getAttribute('data-options'))
  document.querySelector('head').appendChild(s)
</script>
{{--::END:: Bitbucket-Required JS--}}
</body>
</html>
