
//Javascript voor prijs range
/*
$( function() {
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 10, 200 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "€" + ui.values[ 0 ] + " - €" + ui.values[ 1 ] );
        }
    });
    $( "#amount" ).val( "€" + $( "#slider-range" ).slider( "values", 0 ) +
        " - €" + $( "#slider-range" ).slider( "values", 1 ) );
} );
*/

//Javascript + en - aantal detailpagina
$(document).on('click', '.number-spinner button', function () {
    var btn = $(this),
        oldValue = btn.closest('.number-spinner').find('input').val().trim(),
        newVal = 0;

    if (btn.attr('data-dir') == 'up') {
        newVal = parseInt(oldValue) + 1;
    } else {
        if (oldValue > 1) {
            newVal = parseInt(oldValue) - 1;
        } else {
            newVal = 1;
        }
    }
    btn.closest('.number-spinner').find('input').val(newVal);
});

//Star rating
/*document.addEventListener('DOMContentLoaded', function(){
    let stars = document.querySelectorAll('.star');
    stars.forEach(function(star){
        star.addEventListener('click', setRating);
    });

    let rating = parseInt(document.querySelector('.stars').getAttribute('data-rating'));
    let target = stars[rating - 1];
    target.dispatchEvent(new MouseEvent('click'));
});

function setRating(ev){
    let span = ev.currentTarget;
    let stars = document.querySelectorAll('.star');
    let match = false;
    let num = 0;
    stars.forEach(function(star, index){
        if(match){
            star.classList.remove('rated');
        }else{
            star.classList.add('rated');
        }
        //are we currently looking at the span that was clicked
        if(star === span){
            match = true;
            num = index + 1;
        }
    });
    document.querySelector('.stars').setAttribute('data-rating', num);
}*/

//
$(function () {
    $('.example2').DataTable({
        "paging": true,
        "lengthMenu": [5, 25, 50, 100],
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});

$.widget.bridge('uibutton', $.ui.button);



//CK-Editor 5:
//Standard
/*ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
        console.error( error );
    } );*/

//Custom
/*ClassicEditor
    .create( document.querySelector( '#editor' ),{
        toolbar: ['bold', 'italic', 'blockQuote', 'undo', 'redo']
    } )
    .catch( error => {
        console.error( error );
    } );*/


//Script foto weergave bij veranderen foto
/*function showImage(src, target) {
    var fr = new FileReader();

    fr.onload = function () {
        target.src = fr.result;
    }
    fr.readAsDataURL(src.files[0]);

}

function putImage() {
    var src = document.getElementById("select_image");
    var target = document.getElementById("target");
    showImage(src, target);
}


//Alert fade script
$(document).ready(function () {
    setTimeout(function () {
        $(".alert").alert('close');
    }, 3000);
});*/

