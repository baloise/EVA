$(document).ready(function(){
    
    $('.corrSubAvg').each(function(){
    
        $(this).click(function(){
            
            $(this).prop("disabled",true);
        
            var subid = $(this).attr('subjid');
            
            $('.corrSubAvgNum').each(function(){
                
                if($(this).attr('subjid') == subid){
                    
                    var corrGrade = $(this).val();
                    
                    $.ajax({
                        method: "POST",
                        url: "./modul/noten/modify.php",
                        data: {todo:"correction", subid:subid, corrGrade:corrGrade},
                        success: function(data){
                            
                            if(data){

                                alert(data);
                            
                            } else {
                                
                                $(this).prop("disabled",false);
                                
                                $('.subAvg').each(function(){
                                
                                    if($(this).attr('subjid') == subid){
                                        var text = $(this).html();
                                        
                                        var newText = "<s>" + text + "</s> <b style='color:red'>" + corrGrade + "</b>";
                                        
                                        $(this).html(newText);
                                        
                                    }
                                    
                                });
                                
                            }
                                     
                        }
                    });
                    
                }
            
            });
            
        });
        
    });
    
    $('.userGradesHead').each(function(){
        $(this).click(function(){
            
            var selection = $(this).attr("containerID");
            
            $('.detailedGrades').each(function(){
                if($(this).attr("containerID") == selection){
                    $(this).slideToggle("slow");  
                }   
            }); 
        });
    });
    
    $(".btnSelect").each(function(){
        
        $(this).click(function(){
            
            var object = $(this);
            
            $(".btnSelect").each(function(){
                $(this).removeClass("btn-success", 1000);
                $(this).removeClass("selectedType");
            });
            
            $(object).addClass("btn-success", 1000);
            $(object).addClass("selectedType");
                
        });
        
    });
    
    $('.addGrade').each(function(){
        
        $(this).click(function(){
            
            $('.alert-danger').each(function(){
                $(this).slideUp("fast");    
            });
            
            $('.addGrade').each(function(){
                $(this).prop("disabled",true);
            });
            
            var subjectId = $(this).attr('fSubject');
            var weight, title, grade, reason;
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
            
            $('.fgradeReason').each(function(){
                if($(this).attr('fSubject') == subjectId){
                    reason = $(this).val();
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
            
            if(grade < 4 && !reason){
                error = error + "Bitte Begründung für Note unter 4.0 angeben<br/>";
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
                    data: {todo:"addGrade", grade:grade, title:title, weight:weight, subjectId:subjectId, reason:reason},
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
                                $("#pageContent").load("modul/noten/noten.php", function(){
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
    
    $('.divtoggler').each(function(){
        
        $(this).click(function(){
        
            var subSemId = $(this).attr("subSemid");
            
            $(".divtogglercontent").each(function(){
                
                if($(this).attr("subSemid") == subSemId){
                    $(this).slideToggle("fast");
                }
            
            });
            
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
                                       $("#pageContent").load("modul/noten/noten.php", function(){
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
    
        var error = "";
    
        var subName = $('#newSubNam').val();
        var subSem = $('#newSubSem').val();
        var subType = 1;
        
        if($("#LIT").length){
            
            alert("is LIT");
            
            var i = 0;
            $('.selectedType').each(function(){
                i = i + 1;    
            });
            
            if(i == 1){
                subType = $('.selectedType').attr("value");
            } else {
                error = error + "Bitte Fach-Typ angeben.<br/>";
            }
            
            alert(subType);
            
        }
        
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
                data: {todo:"addSubject", subName:subName, subSem:subSem, subType:subType},
                success: function(data){
                            
                    if(data){
                                
                        $('#errorForm').html(data).slideDown("slow");
                        $('#addSubject').prop("disabled",false);
    
                    } else {
                        
                        $("#addedNotif2").slideDown("fast").delay(1300).slideUp("fast",function(){
                            $("#pageContent").load("modul/noten/noten.php", function(){
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
 
    $('.fgradeNote').each(function(){
        $(this).keyup(function(){
            
            var fid = $(this).attr("fSubject");
            
            if($(this).val() <= 4 && $(this).val()){
                $('.badDay').each(function(){
                    if($(this).attr("fSubject") == fid){
                        $(this).slideDown("slow");
                    }    
                });
            } else {
                $('.badDay').each(function(){
                    if($(this).attr("fSubject") == fid){
                        $(this).slideUp("slow");
                    }    
                });
            }
        }); 
    });
 
    $('.contentToggler').each(function(){
        
        $(this).click(function(){
            
            var semID = $(this).attr("semID");
            
            $(".toggleContent").each(function(){
            
                if($(this).attr("semID") == semID){
                    $(this).slideToggle("fast");
                }
                
            });
        
        });
    
    });
 
});