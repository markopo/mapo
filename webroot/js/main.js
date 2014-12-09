/**
 * Created by marko on 07/11/2014.
 */


function appendScript(src){
    var script = document.createElement("script");
    script.src = src;
    document.body.appendChild(script);

}