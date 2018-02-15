$(document).ready(function(){
    
    

});

function toggleGroup(groupID){
    
    $('.groupContent').each(function(){
    
        if($(this).attr("groupID") == groupID){
            $(this).slideToggle("fast");   
        }
        
    });
    
}

function toggleUser(userID){
    
    $('.userContent').each(function(){
    
        if($(this).attr("userID") == userID){
            $(this).slideToggle("fast");   
        }
        
    });
    
}

function toggleCycle(userID, cycleID){
    
    $('.loading').each(function(){
        $(this).slideDown("fast");
    });
    
    $('.cycleContent').each(function(){
    
        if($(this).attr("userID") == userID && $(this).attr("cycleID") == cycleID){
            
            var cycleContentObject = $(this);
            
            $(cycleContentObject).slideToggle("fast");
            
            $.ajax({
                method: "POST",
                url: "./modul/leistungslohn/getContent.php",
                data: {userID:userID, cycleID:cycleID},
                success: function(data){
                    if(data){           
                        
                        $('.loading').each(function(){
                            $(this).slideUp("slow");
                        });
                        
                        $(cycleContentObject).html(data);
                                                
                    } else {
                        
                        $('.loading').each(function(){
                            $(this).slideUp("slow");
                        });
                        
                        $(cycleContentObject).html("Fehler: Keine/Leere Antwort erhalten.");
                        
                    }
                
                }
            });
            
        }
        
    });
    
}

function toggleSemester(userID, semesterID){
    
    $('.semesterContent').each(function(){
    
        if($(this).attr("userID") == userID && $(this).attr("semesterID") == semesterID){
            $(this).slideToggle("fast");   
        }
        
    });
    
}

function toggleCycleExam(userID, cycleID){
    
    $('.cycleContentExam').each(function(){
		
        if($(this).attr("userID") == userID && $(this).attr("cycleID") == cycleID){
            $(this).slideToggle("fast");   
        }
        
    });
    
}