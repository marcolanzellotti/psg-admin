<script src="/psg-admin/assets/js/main.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, {});

        var elems = document.querySelectorAll('.dropdown-trigger');
        var instances = M.Dropdown.init(elems, {
            hover: false
        });
    });
    $('.sidenav').sidenav()
    $('select').formSelect()
    $('.materialboxed').materialbox()
</script>