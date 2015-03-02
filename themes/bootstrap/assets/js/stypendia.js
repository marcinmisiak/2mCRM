$(document).ready(function(){
	$(function () {
	    $('#btnAdd').click(function () {
	        var num     = $('.clonedInput').length, // how many "duplicatable" input fields we currently have
	            newNum  = new Number(num + 1),      // the numeric ID of the new input field being added
	            newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
	    // manipulate the name/id values of the input inside the new element
	        // H2 - section
	        newElem.find('.heading-reference').attr('id', 'ID' + newNum + '_reference').attr('name', 'ID' + newNum + '_reference').html('Osoba nr: ' + newNum);
	 
	        // Title - select
	       // newElem.find('.label_ttl').attr('for', 'ID' + newNum + '_title');
	       // newElem.find('.select_ttl').attr('id', 'ID' + newNum + '_title').attr('name', 'ID' + newNum + '_title').val('');
	 
	        // First name - text
	        newElem.find('.label_nazwisko').attr('for', 'ID' + newNum + '_nazwisko');
	        //newElem.find('.input_fn').attr('id', 'ID' + newNum + '_first_name').attr('name', 'ID' + newNum + '_first_name').val('');
	    	newElem.find('.input_nazwisko').attr('id', 'ID' + newNum + '_nazwisko').val('');
	 
	    
	        // Last name - text
	        newElem.find('.label_dataur').attr('for', 'ID' + newNum + '_dataur');
	        newElem.find('.input_dataur').attr('id', 'ID' + newNum + '_dataur').val('');
	 
	        
	        newElem.find('.label_stopienpok').attr('for', 'ID' + newNum + '_stopienpok');
	        newElem.find('.input_stopienpok').attr('id', 'ID' + newNum + '_stopienpok').val('');
	        
	        
	        newElem.find('.label_miejscezat').attr('for', 'ID' + newNum + '_miejscezat');
	        newElem.find('.input_miejscezat').attr('id', 'ID' + newNum + '_miejscezat').val('');
	        // Color - checkbox
	        //newElem.find('.label_checkboxitem').attr('for', 'ID' + newNum + '_checkboxitem');
	        //newElem.find('.input_checkboxitem').attr('id', 'ID' + newNum + '_checkboxitem').attr('name', 'ID' + newNum + '_checkboxitem').val([]);
	 
	        // Skate - radio
	       // newElem.find('.label_radio').attr('for', 'ID' + newNum + '_radioitem');
	       // newElem.find('.input_radio').attr('id', 'ID' + newNum + '_radioitem').attr('name', 'ID' + newNum + '_radioitem').val([]);
	 
	        // Email - text
	       // newElem.find('.label_email').attr('for', 'ID' + newNum + '_email_address');
	       // newElem.find('.input_email').attr('id', 'ID' + newNum + '_email_address').attr('name', 'ID' + newNum + '_email_address').val('');
	 
	    // insert the new element after the last "duplicatable" input field
	        $('#entry' + num).after(newElem);
	        $('#ID' + newNum + '_title').focus();
	 
	    // enable the "remove" button
	        $('#btnDel').attr('disabled', false);

	   	 
	    // right now you can only add 5 sections. change '5' below to the max number of times the form can be duplicated
	        if (newNum == 20)
	        $('#btnAdd').attr('disabled', true).prop('value', "Więcej osób nie możemy zapisać ");
	        $('#iloscosob').attr('value', newNum);
	        $('#iloscosob_widoczne').attr('value', newNum);
	       
	    });
	 
	    $('#btnDel').click(function () {
	    // confirmation
	        if (confirm("Jesteś pewny, że chesz usunąć osobę? Utracisz jej dane."))
	            {
	                var num = $('.clonedInput').length;
	                // how many "duplicatable" input fields we currently have
	                $('#entry' + num).slideUp('slow', function () {$(this).remove();
	                // if only one element remains, disable the "remove" button
	                    if (num -1 === 1)
	                $('#btnDel').attr('disabled', true);
	                // enable the "add" button
	                $('#btnAdd').attr('disabled', false).prop('value', "Nowa osoba");});
	                $('#iloscosob').attr('value', num-1);
	                $('#iloscosob_widoczne').attr('value', num-1);
	            }
	        return false;
	             // remove the last element
	 
	    // enable the "add" button
	        $('#btnAdd').attr('disabled', false);
	    });
	 
	    $('#btnDel').attr('disabled', true);
	    
	    $('#btnAddUS').click(function () {
	        var num     = $('.clonedInputUS').length, // how many "duplicatable" input fields we currently have
	            newNum  = new Number(num + 1),      // the numeric ID of the new input field being added
	            
	            newElem = $('#dokumentUS' + num).clone().attr('id', 'dokumentUS' + newNum).fadeIn('slow'); 
	        
	        	newElem.find('.heading-reference').attr('id', 'ID' + newNum + '_us').attr('name', 'ID' + newNum + '_us').html('Dokument nr: ' + newNum);
	        	newElem.find('.label_dochod').attr('for', 'ID' + newNum + '_dochod');
	        	newElem.find('.input_dochod').attr('id', 'ID' + newNum + '_dochod').val('');
	        	newElem.find('.label_podateknal').attr('for', 'ID' + newNum + '_podateknal');
	        	newElem.find('.input_podateknal').attr('id', 'ID' + newNum + '_podateknal').val('');
	        	newElem.find('.label_sklspoleczne').attr('for', 'ID' + newNum + '_sklspoleczne');
	        	newElem.find('.input_sklspoleczne').attr('id', 'ID' + newNum + '_sklspoleczne').val('');
	        	newElem.find('.label_sklzdrowotne').attr('for', 'ID' + newNum + '_sklzdrowotne');
	        	newElem.find('.input_sklzdrowotne').attr('id', 'ID' + newNum + '_sklzdrowotne').val('');
	        	newElem.find('.label_liczbamiesiecy').attr('for', 'ID' + newNum + '_liczbamiesiecy');
	        	newElem.find('.input_liczbamiesiecy').attr('id', 'ID' + newNum + '_liczbamiesiecy').val('12');
	 
	        	
	        	
	        	
	        $('#dokumentUS' + num).after(newElem);
	        $('#ID' + newNum + '_dochod').focus();
	        $('#btnDelUS').attr('disabled', false);
	    });
	    $('#btnDelUS').click(function () {
		        if (confirm("Jesteś pewny, że chesz usunąć dokument? Utracisz  dane."))
		            {
		                var num = $('.clonedInputUS').length;
		                $('#dokumentUS' + num).slideUp('slow', function () {$(this).remove();
		                if (num -1 === 1)
		                $('#btnDelUS').attr('disabled', true);
		                $('#btnAddUS').attr('disabled', false).prop('value', "Dodaj dokument");});
		                
		            }
		        return false;
		        $('#btnAddUS').attr('disabled', false);
		    });
	    
	    $('#btnDelUS').attr('disabled', true);
	    
	    $('#btnAddAL').click(function () {
	        var num     = $('.clonedInputAL').length, // how many "duplicatable" input fields we currently have
	            newNum  = new Number(num + 1),      // the numeric ID of the new input field being added
	            
	            newElem = $('#dokumentAL' + num).clone().attr('id', 'dokumentAL' + newNum).fadeIn('slow'); 
	        
	        	newElem.find('.heading-reference').attr('id', 'ID' + newNum + '_al').attr('name', 'ID' + newNum + '_al').html('Zaświadczenie o alimentantach nr: ' + newNum);
	        	newElem.find('.label_alimenty_dochod').attr('for', 'ID' + newNum + '_alimenty_dochod').val('');
	        	newElem.find('.input_alimenty_dochod').attr('id', 'ID' + newNum + '_alimenty_dochod').val('');
	        	newElem.find('.label_alimenty_nazwisko').attr('for', 'ID' + newNum + '_alimenty_nazwisko');
	        	newElem.find('.input_alimenty_nazwisko').attr('id', 'ID' + newNum + '_alimenty_nazwisko').val('');
	        	
	        $('#dokumentAL' + num).after(newElem);
	        $('#ID' + newNum + '_alimenty_dochod').focus();
	        $('#btnDelAL').attr('disabled', false);
	    });
	    $('#btnDelAL').click(function () {
		        if (confirm("Jesteś pewny, że chesz usunąć dokument? Utracisz  dane."))
		            {
		                var num = $('.clonedInputAL').length;
		                $('#dokumentAL' + num).slideUp('slow', function () {$(this).remove();
		                if (num -1 === 1)
		                $('#btnDelAL').attr('disabled', true);
		                $('#btnAddAL').attr('disabled', false).prop('value', "Dodaj dokument");});
		                
		            }
		        return false;
		        $('#btnAddAL').attr('disabled', false);
		    });
	    
	    $('#btnDelAL').attr('disabled', true);
	    
	    $('#btnAddH').click(function () {
	        var num     = $('.clonedInputH').length, // how many "duplicatable" input fields we currently have
	            newNum  = new Number(num + 1),      // the numeric ID of the new input field being added
	            
	            newElem = $('#dokumentH' + num).clone().attr('id', 'dokumentH' + newNum).fadeIn('slow'); 
	        
	        	newElem.find('.heading-reference').attr('id', 'ID' + newNum + '_h').attr('name', 'ID' + newNum + '_h').html('Działaka nr: ' + newNum);
	        	newElem.find('.label_hektary_liczba').attr('for', 'ID' + newNum + '_hektary_liczba');
	        	newElem.find('.input_hektary_liczba').attr('id', 'ID' + newNum + '_hektary_liczba').val('');
	        	newElem.find('.label_hektary_nazwisko').attr('for', 'ID' + newNum + '_hektary_nazwisko');
	        	newElem.find('.input_hektary_nazwisko').attr('id', 'ID' + newNum + '_hektary_nazwisko').val('');
	        	
	        $('#dokumentH' + num).after(newElem);
	        $('#ID' + newNum + '_hektary_liczba').focus();
	        $('#btnDelH').attr('disabled', false);
	    });
	    $('#btnDelH').click(function () {
		        if (confirm("Jesteś pewny, że chesz usunąć dokument? Utracisz  dane."))
		            {
		                var num = $('.clonedInputH').length;
		                $('#dokumentH' + num).slideUp('slow', function () {$(this).remove();
		                if (num -1 === 1)
		                $('#btnDelH').attr('disabled', true);
		                $('#btnAddH').attr('disabled', false).prop('value', "Dodaj dokument");});
		                
		            }
		        return false;
		        $('#btnAddH').attr('disabled', false);
		    });
	    
	    $('#btnDelH').attr('disabled', true);
	    
	    //inne
	    $('#btnAddInne').click(function () {
	        var num     = $('.clonedInputInne').length, 
	            newNum  = new Number(num + 1),     
	            
	            newElem = $('#dokumentInne' + num).clone().attr('id', 'dokumentInne' + newNum).fadeIn('slow'); 
	        
	        	newElem.find('.heading-reference').attr('id', 'ID' + newNum + '_inne').attr('name', 'ID' + newNum + '_inne').html('Dokument nr: ' + newNum);
	        	newElem.find('.label_inne_rodzaj').attr('for', 'ID' + newNum + '_inne_rodzaj');
	        	newElem.find('.input_inne_rodzaj').attr('id', 'ID' + newNum + '_inne_rodzaj').val('');
	        	newElem.find('.label_inne_dochod').attr('for', 'ID' + newNum + '_inne_dochod');
	        	newElem.find('.input_inne_dochod').attr('id', 'ID' + newNum + '_inne_dochod').val('');
	        	
	        $('#dokumentInne' + num).after(newElem);
	        $('#ID' + newNum + '_inne_rodzaj').focus();
	        $('#btnDelInne').attr('disabled', false);
	    });
	    $('#btnDelInne').click(function () {
		        if (confirm("Jesteś pewny, że chesz usunąć dokument? Utracisz  dane."))
		            {
		                var num = $('.clonedInputInne').length;
		                $('#dokumentInne' + num).slideUp('slow', function () {$(this).remove();
		                if (num -1 === 1)
		                $('#btnDelInne').attr('disabled', true);
		                $('#btnAddInne').attr('disabled', false).prop('value', "Dodaj dokument");});
		                
		            }
		        return false;
		        $('#btnAddInne').attr('disabled', false);
		    });
	    
	    $('#btnDelInne').attr('disabled', true);
	    
	    $('#label_stud_kontostud').show();
	    $('#czesne').click(function() {
	    	if($('#czesne').is( ":checked" )) {
	    		$('#stud_kontostud').attr('disabled', true);
	    		 $('#label_stud_kontostud').hide();
	    	} else {
	    		$('#label_stud_kontostud').show();
		    	 $('#stud_kontostud').attr('disabled', false);
		    	 $('#stud_kontostud').focus();
	    		 
	    	}
	    });
	    
	    $('#o1').attr('disabled',true);
		$('#o1').hide();
	    $("#o1_tn").change(function() {
	    	 if ($('#o1_tn option:selected').val() == 'T') {
	    		 $('#o1').attr('disabled',false);
	    		 $('#o1').show();
	    	 } else {
	    		 $('#o1').attr('disabled',true);
	    		 $('#o1').hide();
	    	 }
	    });
	    $('#o2').attr('disabled',true);
		$('#o2').hide();
	    $("#o2_tn").change(function() {
	    	 if ($('#o2_tn option:selected').val() == 'T') {
	    		 $('#o2').attr('disabled',false);
	    		 $('#o2').show();
	    	 } else {
	    		 $('#o2').attr('disabled',true);
	    		 $('#o2').hide();
	    	 }
	    });
	    $('#o3').attr('disabled',true);
		$('#o3').hide();
	    $("#o3_tn").change(function() {
	    	 if ($('#o3_tn option:selected').val() == 'T') {
	    		 $('#o3').attr('disabled',false);
	    		 $('#o3').show();
	    	 } else {
	    		 $('#o3').attr('disabled',true);
	    		 $('#o3').hide();
	    	 }
	    });
	 
	});
 
});