$(".pagination").on('click', function() {
	pagination(post = $(this).text());
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_csrf"]').attr('content')
    }
});
function DeleteUser(element){
    if(confirm("Delete this user ?")){
        $.ajax({
            url: window.location['href'] + 'delete/user',
            type: 'post',
            data: {
                user: $(element).attr('data-id')
            },
            success: function(data){
                alert(data.msg);
                pagination('users');
            }
        });
    }
}
function DeleteCompany(element){
    if(confirm("Delete this company? All users of the company will be deleted.")){
        $.ajax({
            url: window.location['href'] + 'delete/company',
            type: 'post',
            data: {
                company: $(element).attr('data-name')
            },
            success: function(data){
                alert(data.msg);
                pagination('companies');
            }
        });
    }
}
function EditCompany(form){
        $.ajax({
		url: window.location['href'] + 'edit/company',
		type: 'post',
		data: $(form).serialize(),
                success: function(data){
                    alert(data.msg);
                    modalHide();
                    $('#edit-form').remove();
                    pagination('companies');
                }
	});
};
function EditUser(form){
        $.ajax({
		url: window.location['href'] + 'edit/user',
		type: 'post',
		data: $(form).serialize(),
                success: function(data){
                    alert(data.msg);
                    modalHide();
                    $('#edit-form').remove();
                    pagination('users');
                }
	});
};
function ShowCompany(element){
    $.ajax({
            url: window.location['href'] + 'edit/company/' + $(element).attr('data-name'),
            type: 'post',
            success: function(data){
                $('#edit-modal-body').append(data.msg);
                modalShow('edit-modal');
            }
        });
}
function ShowUser(element){
    $.ajax({
            url: window.location['href'] + 'edit/user/' + $(element).attr('data-id'),
            type: 'post',
            success: function(data){
                $('#edit-modal-body').append(data.msg);
                modalShow('edit-modal');
            }
        });
}
function ViewAbusers(element){
    $.ajax({
            url: window.location['href'] + '/abusers',
            type: 'post',
            data: {
                company: $(element).attr('data-id')
            },
            success: function(data){
                $('#edit-modal-body').append(data.msg);
                modalShow('edit-modal');
            }
        });
}
function pagination(post){
	$.ajax({
		url: window.location['href'] + 'page',
		type: 'post',
		dataType: 'json',
		data: {
                    page: post
		},
                success: function(data){
                    $('.section').html(data.msg);
                }
	});	
}
function fakeGenerator(element){
    $.ajax({
		url: window.location['href'] + 'fake',
		type: 'post',
		dataType: 'json',
                data: {
                    type: $(element).attr('data-id')
                },
                success: function(data){
                    alert(data.msg);   
                }
	});
}
function modalHide(){
	$('.modal').hide();
}
function modalShow(id){
	$('.' + id).show();
}
function modalEditHide(){
    $('.modal').hide();
    $('#edit-form').remove();
    $('.abusers-list').remove();
}
$('#add-company').submit(function(event) {
	event.preventDefault();
        $.ajax({
		url: window.location['href'] + 'add/company',
		type: 'post',
		data: $(this).serialize(),
                success: function(data){
                    alert(data.msg);
                    modalHide();
                    pagination('companies');
                }
	});
});
$('#add-user').submit(function(event) {
	event.preventDefault();
        $.ajax({
		url: window.location['href'] + 'add/user',
		type: 'post',
		data: $(this).serialize(),
                success: function(data){
                    alert(data.msg);
                    modalHide();
                    pagination('users');
                }
	});
});