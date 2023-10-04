<div id="lone" class="col-left">
	<div id="smenu" class="sidebar stickybox shadow">
        <div class="menuitem" onclick=postIt('indexAuth');>Custom Software</div>
        <div class="menuitem" onclick=postIt('pagetwo');>Computer Languages</div>
        <div class="menuitem" onclick=postIt('pagethree');>General Systems</div>
        <div class="menuitem" onclick=postIt('pagefour');>Microsoft Systems</div>
        <div class="menuitem" onclick=postIt('pagefive');>Databases</div>
        <div class="menuitem" onclick=postIt('pagesix');>Methodologies</div>
        <div class="menuitem" onclick=postIt('pagenine');>Problem Domain</div>
        <div class="menuitem" onclick=postIt('page_sdlc');>SDLC</div>
        <div class="menuitem" onclick="location.href='glossy2'">Example Website</div>
        <div class="menuitem" onclick="location.href='pageseven'">High Tech News</div>
        <div class="menuitem" onclick="location.href='contact'">Contact</div>
        <div class="menuitem" onclick=postIt('userList');>User List</div>
        <div class="menuitem" onclick=logout();>Logout</div>
	</div>
	<div id="skeybox" class="stickybox sidebox smlrtxt">
		Success in computer science comes from striving to be a skilled student of technology and always continue improving. Then working hard to become an expert and teach others to do the same. It can be a way to intellectually grow, prosper and forever stay energized, relevant, enthusiastic and prosperous.
	</div>
	<img id="cpp_logo" src="../res/img/c.svg" width="200" height="200" alt="c++ logo" class="stickybox sidelogo">
</div>
<script>
function postIt( purl ) {
    var form = document.createElement('form');
    form.setAttribute('method', 'POST');
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
    