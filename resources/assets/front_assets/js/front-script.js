/*
import * as noUiSlider from "nouislider";
window.noUiSlider = noUiSlider;*/
//Javascript voor prijs range
/*$( function() {
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
} );*/

//No UI-Slider:
/*var slider = document.getElementById('slider');

noUiSlider
    .create(slider, {
    start: [20, 80],
    connect: true,
    range: {
        'min': 0,
        'max': 100
    }
});*/
/*var skipSlider = document.getElementById('skipstep');

noUiSlider.create(skipSlider, {
    range: {
        'min': 0,
        '10%': 10,
        '20%': 20,
        '30%': 30,
        '40%': 40,
        '50%': 50,
        '60%': 60,
        '70%': 70,
        '80%': 80,
        '90%': 90,
        'max': 100
    },
    snap: true,
    start: [10, 90]
});*/

/*var skipValues = [
    document.getElementById('skip-value-lower'),
    document.getElementById('skip-value-upper')
];

skipSlider.noUiSlider.on('update', function (values, handle) {
    skipValues[handle].innerHTML = values[handle];
});*/
//Ckeditor 5:

/*ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
        console.error( error );
    } );*/


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



