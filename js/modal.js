// $('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
//   var $this = $(this),
//       label = $this.prev('label');

// 	  if (e.type === 'keyup') {
// 			if ($this.val() === '') {
//           label.removeClass('active highlight');
//         } else {
//           label.addClass('active highlight');
//         }
//     } else if (e.type === 'blur') {
//     	if( $this.val() === '' ) {
//     		label.removeClass('active highlight'); 
// 			} else {
// 		    label.removeClass('highlight');   
// 			}   
//     } else if (e.type === 'focus') {
      
//       if( $this.val() === '' ) {
//     		label.removeClass('highlight'); 
// 			} 
//       else if( $this.val() !== '' ) {
// 		    label.addClass('highlight');
// 			}
//     }

// });

// $('.tab a').on('click', function (e) {
  
//   e.preventDefault();
  
//   $(this).parent().addClass('active');
//   $(this).parent().siblings().removeClass('active');
//   target = $(this).attr('href');

//   $('.tab-content > div').not(target).hide();
  
//   $(target).fadeIn(600);
  
// });

// CharacterCount = function(TextArea,FieldToCount){
//     var myField = document.getElementById(TextArea);
//     var myLabel = document.getElementById(FieldToCount); 

//     if(!myField || !myLabel){
//       return false;
//     }

//     var MaxChars =  myField.maxLengh;

//     if(!MaxChars){
//       MaxChars =  myField.getAttribute('maxlength'); 
//     }
    
//     if(!MaxChars){
//       return false;
//     }

//     var remainingChars =   MaxChars - myField.value.length
//     myLabel.innerHTML = remainingChars+" Characters Remaining of Maximum "+MaxChars
//   }

//   setInterval(function(){
//     CharacterCount('myfield','CharCountLabel1')
//   },55);

/* function tailleInput(id){
    var id = id.getAttribute("id");
    var textLength = document.getElementById(id).value.length;
    var tailleMax = document.getElementById(id).getAttribute("maxlength");
    document.getElementById("tailleMax").innerHTML = textLength + "/" + tailleMax;
} */

// $('#toggleNavColor').click(function() {
//     $('nav').toggleClass('navbar-dark navbar-light');
//     $('nav').toggleClass('bg-dark bg-light');
//     $('body').toggleClass('bg-dark bg-light');
//   });

$(window).on("load",function(){
    $("#nouvelleEspece").modal("show");
    $("#sidenavToggler").sidenavToggler("show");
});