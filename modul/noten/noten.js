$(document).ready(function(){
    
    $('.addGrade').each(function(){
        
        $(this).click(function(){
            
            $('.alert-danger').each(function(){
                $(this).slideUp("fast");    
            });
            
            $('.addGrade').each(function(){
                $(this).prop("disabled",true);
            });
            
            var subjectId = $(this).attr('fSubject');
            var weight, title, grade;
            var error = "";
            
            $('.fgradeTitle').each(function(){
                if($(this).attr('fSubject') == subjectId){
                    title = $(this).val();
                }
            });
            
            $('.fgradeNote').each(function(){
                if($(this).attr('fSubject') == subjectId){
                    grade = $(this).val();
                }
            });
            
            $('.fgradeWeight').each(function(){
                if($(this).attr('fSubject') == subjectId){
                    weight = $(this).val();
                }
            });
            
            if(!weight){
                error = error + "Bitte Gewichtung angeben<br/>";
            }
            
            if(!title){
                error = error + "Bitte Titel angeben<br/>";
            }
            
            if(!grade){
                error = error + "Bitte Note angeben<br/>";
            }
            
            if(error){
                
                $('.alert-danger').each(function(){
                    if($(this).attr('fSubject') == subjectId){
                        $(this).html(error).slideDown("slow");
                    }
                });
                $('.addGrade').each(function(){
                    $(this).prop("disabled",false);
                });
                
            } else {
                
                $('.alert-danger').each(function(){
                    $(this).slideUp("fast");    
                });
                
                $.ajax({
                    method: "POST",
                    url: "./modul/noten/modify.php",
                    data: {todo:"addGrade", grade:grade, title:title, weight:weight, subjectId:subjectId},
                    success: function(data){
                        
                        if(data){
                            if(data == "Berechtigungsfehler"){
                                alert(data);
                            }
                            $('.alert-danger').each(function(){
                                if($(this).attr('fSubject') == subjectId){
                                    $(this).html(data).slideDown("slow");
                                }
                            });
                            $('.addGrade').each(function(){
                                $(this).prop("disabled",false);
                            });

                        } else {
                                    
                            $("#addedNotif").slideDown("fast").delay(1300).slideUp("fast",function(){
                                $("#pageContent").load("modul/noten.php", function(){
                                    $('.loadScreen').fadeTo("fast", 0, function(){
                                        $('#pageContents').fadeTo("fast", 1);
                                    });
                                });
                            });
                                
                        }
                                 
                    }
                });
                
            }
            
            
        });
            
    });

    $('.delGrade').each(function(){
        
        $(this).click(function(){
            
            var gradeId = $(this).attr('gradeId');
            
            if(!gradeId){
                alert("Fehler");
            } else {
                
                $.ajax({
                    method: "POST",
                    url: "./modul/noten/modify.php",
                    data: {todo:"deleteGrade", gradeId:gradeId},
                    success: function(data){
                        
                        if(data){
                            
                            alert(data);

                        } else {
                                    
                            $('.gradeEntry').each(function(){
                                if($(this).attr('gradeId') == gradeId){
                                    $(this).slideUp("slow", function(){
                                       $("#pageContent").load("modul/noten.php", function(){
                                            $('.loadScreen').fadeTo("fast", 0, function(){
                                                $('#pageContents').fadeTo("fast", 1);
                                            });
                                        });
                                    });
                                }    
                            });
                                
                        }
                                 
                    }
                });
                
            }
            
        });
            
    });
    
    $('#addSubject').click(function(){
    
        $('#errorForm').html(error).slideUp("fast");
        $('#addSubject').prop("disabled",true);
    
        var subName = $('#newSubNam').val();
        var subSem = $('#newSubSem').val();
        var error = "";
        
        if(!subName){
            error = error + "Bitte Fach angeben.<br/>";
        }
        
        if(!subSem || subSem == "Semester:"){
            error = error + "Bitte Semester angeben.<br/>";
        }
        
        if(error){
            
            $('#errorForm').html(error).slideDown("slow");
                        
            $('#addSubject').prop("disabled",false);
            
        } else {
            $.ajax({
                method: "POST",
                url: "./modul/noten/modify.php",
                data: {todo:"addSubject", subName:subName, subSem:subSem},
                success: function(data){
                            
                    if(data){
                                
                        $('#errorForm').html(data).slideDown("slow");
                        $('#addSubject').prop("disabled",false);
    
                    } else {
                        
                        $("#addedNotif2").slideDown("fast").delay(1300).slideUp("fast",function(){
                            $("#pageContent").load("modul/noten.php", function(){
                                $('.loadScreen').fadeTo("fast", 0, function(){
                                    $('#pageContents').fadeTo("fast", 1);
                                });
                            });
                        });  
                        
                                    
                    }
                                     
                }
            });
        }
        
    });
   
    $('.deleteSubject').each(function(){
        
        $(this).click(function(){
        
            $(this).html("<b style='color: orange; text-decoration: underline'>Bist du dir sicher? Dabei werden alle Noten gelöscht...</b>");
        
            $(this).click(function(){
               
               var subId = $(this).attr('subjectId');
                
                if(!subId){
                    alert("Kein Fach angegeben.<br/>");
                } else {
                    $.ajax({
                        method: "POST",
                        url: "./modul/noten/modify.php",
                        data: {todo:"deleteSubject", subId:subId},
                        success: function(data){
                                    
                            if(data){
                                        
                               alert(data);
            
                            } else {
                                
                                $('.delSubTag').each(function(){
                                
                                    if($(this).attr('fSubject') == subId){
                                        $(this).slideUp('slow');
                                    }
                                    
                                });
                                            
                            }
                                             
                        }
                    });
                }
                
            });
            
        });
    
    });   
 
});