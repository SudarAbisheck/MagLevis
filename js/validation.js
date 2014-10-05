 function validate()
            {
               if( document.bookform.firstname.value == "" )
               {
                 document.getElementById("fname-error").innerHTML="Required";
                 document.bookform.firstname.focus() ;
                 return false;
               }else{
                document.getElementById("fname-error").innerHTML="";
               }


               if( document.bookform.lastname.value == "" )
               {
                 document.getElementById("lname-error").innerHTML="Required";
                 document.bookform.firstname.focus() ;
                 return false;
               }else{
                document.getElementById("lname-error").innerHTML="";
               }


              if( document.bookform.email.value == "" )
               {
                 document.getElementById("email-error").innerHTML="Required";
                 document.bookform.email.focus() ;
                 return false;
               }else if(validateEmail() == false){
                    document.getElementById("email-error").innerHTML="Invalid Email";
                    document.bookform.email.focus() ;
                    return false;
               }
               else{
                document.getElementById("email-error").innerHTML="";
               }

               if(document.bookform.datepicker.value == ""){
                    document.getElementById("date-error").innerHTML="Required";
                    document.bookform.datepicker.focus() ;
                    return false;
               }else{
                     document.getElementById("date-error").innerHTML="";
               }


               if(document.bookform.sourcestn.value == "0"){
                    document.getElementById("source-error").innerHTML="Select Source";
                    document.bookform.sourcestn.focus() ;
                    return false;
               }else{
                document.getElementById("source-error").innerHTML="";
               }

               if(document.bookform.deststn.value == "0"){
                    document.getElementById("dest-error").innerHTML="Select Destination";
                    document.bookform.deststn.focus() ;
                    return false;
               }else{
                var destvalue = document.bookform.deststn.value;
                var sourcevalue = document.bookform.sourcestn.value;
                 if(destvalue == sourcevalue){
                    document.getElementById("dest-error").innerHTML = "Invalid Destination";
                    document.bookform.deststn.focus() ;
                    return false;
                 }else{
                document.getElementById("dest-error").innerHTML="";
               }
               
               }

               if( document.bookform.age.value == "" )
               {
                document.getElementById("age-error").innerHTML = "Required";
                 document.bookform.age.focus() ;
                 return false;
               }else{
                document.getElementById("age-error").innerHTML="";
               }

               if( document.bookform.captcha.value == "" )
               {
                document.getElementById("captcha-error").innerHTML = "Required";
                 document.bookform.age.focus() ;
                 return false;
               }else if(document.bookform.captcha.value != result){
                  document.getElementById("captcha-error").innerHTML = "Wrong Answer";
                 document.bookform.age.focus() ;
                 return false;
               }else{
                document.getElementById("age-error").innerHTML="";
               }
            }

            function validateEmail()
            {
             
               var emailID = document.bookform.email.value;
               atpos = emailID.indexOf("@");
               dotpos = emailID.lastIndexOf(".");
               if (atpos < 1 || ( dotpos - atpos < 2 )) {
                return false;
               }
                   
               return( true );
            }
