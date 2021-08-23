$(document).ready(function() {
    var user = '';
    var selected_users = [];

    $('#bucketNotAvaliable').modal('show');
    $('input[name="input[]"]').click(function() {
        if(this.checked){
            let id = this.value;
            
            $.get( '/organization/set-user/bucket-placement/'+id)
            .done(function( data ) {
                $('#selectedUsers > tbody:last-child').html("");
                $('#placedUser').html("");

                $('#tr'+id).hide()
                selected_users = [];

                $.each(data, function(i, item) {
                    selected_users.push(' '+data[i].firstname +' '+data[i].lastname);

                    $( "#selectedUsers > tbody:last-child" ).append( '<tr id="selected'+data[i].id+'"> <td><input type="checkbox" checked id="'+data[i].id+'" class="i-checks" name="remove[]" value="'+data[i].id+'"></td><td>'+data[i].distid+'</td><td>'+data[i].firstname+'</td><td>'+data[i].lastname+'</td><td>'+data[i].username+'</td><td>'+data[i].created_date+'</td><td></td><td>'+data[i].country_code+'</td></tr>');
                });

                $('#place-selected').removeAttr('hidden');
                //getUsers();
            });
        }
        
    });

    $('#placement-search').on('click', function() {

        let usern = $('#usern').val();
        
         if (usern == "") {
                showPopupNotification("error", "The field cannot be empty");
                return;
            }

        $.get('/organization/get-user/bucket-placement/'+usern)
        .done(function( data ) {
            $('#user-selected').html("");           
            if(data.user != null){
                user = data.user.firstname +' '+ data.user.lastname;

            $( "#user-selected" ).append( '<small class="mb-2">Selected placement will go under:</small><br><strong>'+user+'</strong><br>');
            }else{
                showPopupNotification("error", "User not found");
                return;
            }

            if(data.volumes[0].bv_a != null){
                $('#volumn_bcuket_a').html("");
                $( "#volumn_bcuket_a" ).append( data.volumes[0].bv_a);
            }
            if(data.volumes[0].bv_b != null){
                $('#volumn_bcuket_b').html("");
                $( "#volumn_bcuket_b" ).append( data.volumes[0].bv_b);
            }
            if(data.volumes[0].bv_c != null){
                $('#volumn_bcuket_c').html("");
                $( "#volumn_bcuket_c" ).append( data.volumes[0].bv_c);
            }

         });
    });

    $('#place-selected').on('click', function() {

        let bucket = $('input[name=bucket]:checked').val() ?? 0;
        let bucket_name = "AUTO";

            if(bucket == 1){
                bucket_name = "A";
            }else if(bucket == 2){
                bucket_name = "B";
            }else if(bucket == 3) {
                bucket_name = "C";
            }
        
         if (user == '') {
                showPopupNotification("error", "Please select a user");
                return;
            }
        $('#placedUser').html('');
        $('#placedUser').append('You are about to place <span style="font-size: 14px; font-weight: 600;">'+$.each(selected_users, function(i, item) {
            selected_users[i]
        })+'</span> in bucket <span style="font-size: 14px; font-weight: 600;">'+bucket_name+'</span> under ISBO <span style="font-weight: 600;">'+user+'</span>.</h1>')
        $('#modalConfirmPlace').modal('show');
    });
});

$(document).on('click', 'input[name="remove[]"]',function() {
        if(!this.checked){
            let id = this.value;
            
            $.get( '/organization/remove-user/bucket-placement/'+id)
            .done(function( data ) {
                console.log(data)
                $('#selected'+id).remove();
                $('#placedUser').html("");

                $('#tr'+id).show()
                $('input[name="input[]"]').prop("checked", false);

                if(data.length){
                    $('#place-selected').removeAttr('hidden');
                }else{
                    $('#place-selected').attr('hidden', 'hidden');
                }
                //getUsers();
            });
        }
        
    });