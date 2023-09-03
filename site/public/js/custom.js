// Owl Carousel Start..................
$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});
// Owl Carousel End..................



//Contact Send.......................

$('#contactSendBtnId').click(function(){
    var contactName=$('#contactNameId').val();
    var contactMobile=$('#contactMobileId').val();
    var contactEmail=$('#contactEmaild').val();
    var contactMsg=$('#contactMsgId').val();
    SendContact(contactName,contactMobile,contactEmail,contactMsg);
});


function SendContact(contact_name,contact_mobile,contact_email,contact_msg){
    if(contact_name.length==0){
        $('#contactSendBtnId').html('আপনার নাম লিখুন!');
        setTimeout(function(){
            $('#contactSendBtnId').html('পাঠিয়ে দিন!');
        },2000)
    }
    else if(contact_mobile.length==0){
        $('#contactSendBtnId').html('আপনার মোবাইল নাম্বার লিখুন!');
        setTimeout(function(){
            $('#contactSendBtnId').html('পাঠিয়ে দিন!');
        },2000)
    }
    else if(contact_email.length==0){
        $('#contactSendBtnId').html('আপনার  ইমেইল লিখুন!');
        setTimeout(function(){
            $('#contactSendBtnId').html('পাঠিয়ে দিন!');
        },2000)
    }
    else if(contact_msg.length==0){
        $('#contactSendBtnId').html('আপনার মেসেজ লিখুন!');
        setTimeout(function(){
            $('#contactSendBtnId').html('পাঠিয়ে দিন!');
        },2000)
    }

    else{
        $('#contactSendBtnId').html('পাঠানো হচ্ছে!');
        axios.post('/contactsend',{
            contact_name:contact_name,
            contact_mobile:contact_mobile,
            contact_email:contact_email,
            contact_msg:contact_msg,
    
        })
            .then(function(response){
                if(response.status==200){
                    if(response.data==1){
                        $('#contactSendBtnId').html('অনুরোধ ব্যার্থ হয়েছে!আবার চেষ্টা করুন!');
                        setTimeout(function(){
                            $('#contactSendBtnId').html('পাঠিয়ে দিন!');
                        },2000)  
                    }
                }
                else{
                    $('#contactSendBtnId').html('অনুরোধ ব্যার্থ হয়েছে! আবার চেষ্টা করুন!');
                    setTimeout(function(){
                        $('#contactSendBtnId').html('পাঠিয়ে দিন!');
                    },2000)
                }
    
            }).catch(function(){
                $('#contactSendBtnId').html('আবার চেষ্টা করুন!');
                setTimeout(function(){
                    $('#contactSendBtnId').html('পাঠিয়ে দিন!');
                },2000)
            })
    }
    
}