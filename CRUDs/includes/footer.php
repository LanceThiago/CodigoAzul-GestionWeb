                <div style="width:100%;" class="modal fade" id="modalError" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-white table_button" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<script src="../../jQuery/jQuery.min.js"></script>
<script src="../../datatables/datatables.min.js"></script>
<script src="../../datatables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>
<script src="../../select2/js/select2.min.js"></script>
<script src="../../jQuery/jQuery-validation/jquery.validate.min.js"></script>
<script src="main.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        const showNavbar = (toggleId, navId, bodyId, headerId) =>{
            const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)
            
            if(toggle && nav && bodypd && headerpd){
                toggle.addEventListener('click', ()=>{
                    nav.classList.toggle('show')
                    toggle.classList.toggle('bx-x')
                    bodypd.classList.toggle('body-pd')
                    headerpd.classList.toggle('body-pd')
                })
            }
        }
        
        showNavbar('header-toggle','nav-bar','body-pd','header')
        
        const linkColor = document.querySelectorAll('.nav_link')
        
        function colorLink(){
        if(linkColor){
            linkColor.forEach(l => l.classList.remove('active'))
            this.classList.add('active')
            }
        }
        linkColor.forEach(l=> l.addEventListener('click', colorLink))
    });
</script>
</html>