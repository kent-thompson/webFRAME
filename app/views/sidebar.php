<div id="lone" class="col-left">
    <div id="smenu" class="sidebar stickybox shadow">
        <div class="menuitem" onclick=getIt('indexAuth');>Custom Software</div>
        <div class="menuitem" onclick=getIt('pagetwo'); return false;>Computer Languages</div>
        <div class="menuitem" onclick=getIt('pagethree');>General Systems</div>
        <div class="menuitem" onclick=getIt('pagefour');>Microsoft Systems</div>
        <div class="menuitem" onclick=getIt('pagefive');>Databases</div>
        <div class="menuitem" onclick=getIt('pagesix');>Methodologies</div>
        <div class="menuitem" onclick=getIt('pagenine');>Problem Domain</div>
        <div class="menuitem" onclick=getIt('page_sdlc');>SDLC</div>
        <div class="menuitem" onclick="location.href='glossy2'">Example Website</div>
        <div class="menuitem" onclick="location.href='pageseven'">High Tech News</div>
        <div class="menuitem" onclick="location.href='contact'">Contact</div>
        <div class="menuitem" onclick=getIt('userList');>User List</div>
        <div class="menuitem" onclick=logout();>Logout</div>
    </div>
    <div id="skeybox" class="stickybox sidebox smlrtxt">
        Success in computer science comes from striving to be a skilled student of technology and always continue improving. Then working hard to become an expert and teach others to do the same. It can be a way to intellectually grow, prosper and forever stay energized, relevant, enthusiastic and prosperous.
    </div>
    <img id="cpp_logo" src="../res/img/c.svg" width="200" height="200" alt="c++ logo" class="stickybox sidelogo">
</div>
<script>
var basepath = gGetBasepath();    
function getIt( purl ) {
    if( sessionStorage.getItem('ktc_token') == '' ) {
        alert( 'NO TOKEN' );
        return false;
    }
    // $.ajax({
    //     type:'GET',
    //     url: basepath + '/api/user/validate?data=' + basepath + '/' + purl,

    //     //headers: {'Access-Control-Allow-Headers', '*'},   //for allow any headers, insecure
    //     // headers: {'Access-Control-Allow-Methods', 'GET, POST'} //method allowed
    //     //headers: { 'Access-Control-Allow-Origin': '*',
    //             //'Access-Control-Allow-Headers': '*',
    //             // 'Access-Control-Allow-Methods': 'GET, POST',
    //     headers: {'Authorization': 'Bearer '+ sessionStorage.getItem('ktc_token')},
    //     dataType: 'text',
    //     complete : function(response) {
    //         $.ajax({
    //             type:'POST',
    //             url: basepath + '/' + purl,
    //             headers: {'Authorization': 'Bearer '+ sessionStorage.getItem('ktc_token')}
    //         });
    //     }
    // });

    var form = document.createElement('form');
    form.setAttribute('method', 'GET');
    form.setAttribute('action', purl);
    var hFld = document.createElement('input');
    hFld.setAttribute('type', 'hidden');
    hFld.setAttribute('name', 'jwt');
    hFld.setAttribute('value', sessionStorage.getItem('ktc_token'));
    form.appendChild(hFld);
    document.body.appendChild(form);
    form.submit();
    // another example: document.getElementById("myForm").action = "/action_page.php";
}

function logout() {
    if( confirm("LOG OUT of Application?") == true ) {
        sessionStorage.removeItem('ktc_token');
        location.href='index';
    } 
}
</script>
    