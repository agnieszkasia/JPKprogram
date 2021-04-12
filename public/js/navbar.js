$("#menu-toggle").click(function (e){
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    $("#menu-toggle").toggleClass("toggled");
    $("#sidebar-wrapper").toggleClass("toggled");
});
