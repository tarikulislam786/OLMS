
/**
    Sessions
**/
function addSessionRecord() {
    // get values
    var session_name = $("#session_name").val();
        if(session_name=='')
        {
        alert("Please complete the missing field.");
        return false;
        }
        $.post("ajax/Sessions/addRecord.php", {//alert(session_name);
        type:'POST',
        dataType:'json',
        session_name: session_name,
        created_at: new Date(),
        updated_at: new Date()
    }, function (data, status) {//alert('yep');
        // close the popup
        $("#add_new_record_modal").modal("hide");
        //console.log(data);
        if(data!="")
        alert(data);
        // read records again
        readSessionRecords();

        // clear fields from the popup
        $("#session_name").val("");
    });
   // }
}

// READ records
function readSessionRecords() {
    $.get("ajax/Sessions/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function DeleteSession(id) {
    var conf = confirm("Are you sure, do you really want to delete?");
    if (conf == true) {
        $.post("ajax/Sessions/deleteSession.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readSessionRecords();
                //$('#content').text('Delete successful!').
                //    slideDown('slow');
            }
        );
    }
}

function GetSessionDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/Sessions/readSessionDetails.php", {
            id: id
        },
        function (data, status) {//console.log(data);
            // PARSE json data
            var session = JSON.parse(data);console.log(session)
            // Assing existing values to the modal popup fields
            $("#update_session_name").val(session.session_name);
            //$("#update_status").val(user.status);
            //user.status='1'?$("#update_status").checked(true):$("#update_status").checked(false);
            // ((user.status == 1) ?$("#update_status").prop('checked', true):$("#update_status").prop('checked', false));
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateSessionDetails() {
    // get values
    var update_session_name = $("#update_session_name").val();

    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/Sessions/updateSessionDetails.php", {
            id: id,
            update_session_name: update_session_name,
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readSessionRecords();
        }
    );
}

/**
    Disciplines
**/

function addDisciplineRecord() {
    // get values
    var discipline_name = $("#discipline").val();
    var short_name = $("#short_name").val();
    if(discipline_name=='' || short_name=='')
    {
        alert("Please complete the missing field.");
        return false;
    }
    // Add record
    $.post("ajax/Disciplines/addRecord.php", {//alert(session_name)
        type:'POST',
        dataType:'json',
        name: discipline_name,
        short_name: short_name,
        created_at: new Date(),
        updated_at: new Date()
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");
        if(data!="")
        alert(data);
        // read records again
        readDisciplineRecords();

        // clear fields from the popup
        $("#discipline").val("");
        $("#short_name").val("");
    });
}

// READ records
function readDisciplineRecords() {
    $.get("ajax/Disciplines/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function DeleteDiscipline(id) {
    var conf = confirm("Are you sure, do you really want to delete?");
    if (conf == true) {
        $.post("ajax/Disciplines/deleteDiscipline.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readDisciplineRecords();
            }
        );
    }
}

function GetDisciplineDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/Disciplines/readDisciplineDetails.php", {
            id: id
        },
        function (data, status) {//console.log(data);
            // PARSE json data
            var discipline = JSON.parse(data);console.log(discipline)
            // Assing existing values to the modal popup fields
            $("#update_discipline_name").val(discipline.name);
            $("#update_short_name").val(discipline.short_name);
            //$("#update_status").val(user.status);
            //user.status='1'?$("#update_status").checked(true):$("#update_status").checked(false);
            // ((user.status == 1) ?$("#update_status").prop('checked', true):$("#update_status").prop('checked', false));
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateDisciplineDetails() {
    // get values
    var update_discipline_name = $("#update_discipline_name").val();
    var update_short_name = $("#update_short_name").val();//alert(update_discipline_name)
    // get hidden field value
    var id = $("#hidden_user_id").val();
    //alert(id)
    // Update the details by requesting to the server using ajax
    $.post("ajax/Disciplines/updateDisciplineDetails.php", {
            id: id,
            update_discipline_name: update_discipline_name,
            update_short_name: update_short_name,
        },
        function (data, status) {//alert(data)
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readDisciplineRecords();
        }
    );
}


/**
    Authors
**/

function addAuthorRecord() {
    // get values
    var author_name = $("#author").val();
    if(author_name=='')
    {
        alert("Please complete the missing field.");
        return false;
    }
    // Add record
    $.post("ajax/Authors/addRecord.php", {//alert(session_name)
        type:'POST',
        dataType:'json',
        author_name: author_name,
        created_at: new Date(),
        updated_at: new Date()
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        if(data!="")
            alert(data);
        // read records again
        readAuthorRecords();

        // clear fields from the popup
        $("#author").val("");
    });
}

// READ records
function readAuthorRecords() {
    $.get("ajax/Authors/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function DeleteAuthor(id) {
    var conf = confirm("Are you sure, do you really want to delete?");
    if (conf == true) {
        $.post("ajax/Authors/deleteAuthor.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readAuthorRecords();
            }
        );
    }
}

function GetAuthorDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/Authors/readAuthorDetails.php", {
            id: id
        },
        function (data, status) {//console.log(data);
            // PARSE json data
            var author = JSON.parse(data);//console.log(author)
            // Assing existing values to the modal popup fields
            $("#update_author_name").val(author.author_name);
            //$("#update_status").val(user.status);
            //user.status='1'?$("#update_status").checked(true):$("#update_status").checked(false);
            // ((user.status == 1) ?$("#update_status").prop('checked', true):$("#update_status").prop('checked', false));
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateAuthorDetails() {
    // get values
    var update_author_name = $("#update_author_name").val();
    // get hidden field value
    var id = $("#hidden_user_id").val();
    //alert(id)
    // Update the details by requesting to the server using ajax
    $.post("ajax/Authors/updateAuthorDetails.php", {
            id: id,
            update_author_name: update_author_name,
        },
        function (data, status) {//alert(data)
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readAuthorRecords();
        }
    );
}



/**
    Books
**/

function addBookRecord() {
    // get values
    var book_name = $("#book").val();
    var category_name = $("#category").val();
    var author = $("#author").val();
    var author_name = $("#author_name").val();
    var isbn = $("#isbn").val();
    var price = $("#price").val();
    var piece_of_books = $("#piece_of_books").val();
    if(book_name=='' || category_name=='' || isbn=='' || price=='' || piece_of_books=='')
    {
        alert("Please complete the missing field.");
        return false;
    }
    // Add record
    $.post("ajax/Books/addRecord.php", {//alert(session_name)

        type:'POST',
        dataType:'json',
        book_name: book_name,
        category_name: category_name,
        author_name: author_name,
        author: author,
        isbn: isbn,
        price: price,
        piece_of_books: piece_of_books,
        created_at: new Date(),
        updated_at: new Date()
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");
        if(data!="")
        alert(data);
        // read records again
        readBookRecords();

        // clear fields from the popup
        $("#book").val("");
        $("#category").val("");
        $("#author_name").val("");
        $("#author").val("");
        $("#isbn").val("");
        $("#price").val("");
        $("#piece_of_books").val("");
    });
}

// READ records
function readBookRecords() {
    $.get("ajax/Books/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}



// function readBookRecords(PageIndexDisplay) {
// $.get("ajax/Books/readRecords.php", {},
//    function(data){
//      // data.total have total number of pages
//      $(".records_content").html(data);
//      $('.pagination').bootpag({
//          total: 11,
//          maxVisible: 5,
//      }).on(page, function(event, pageNumber){
//          alert('Page number ' + pageNumber + ' clicked!');
//      });
//    });
// }




function DeleteBook(id) {
    var conf = confirm("Are you sure, do you really want to delete?");
    if (conf == true) {
        $.post("ajax/Books/deleteBook.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readBookRecords();
            }
        );
    }
}

function GetBookDetails(book_id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/Books/readBookDetails.php", {
            book_id: book_id
        },
        function (data, status) {//console.log(data);
            // PARSE json data
            var book = JSON.parse(data);console.log(book);
            // Assing existing values to the modal popup fields
            $("#update_book_name").val(book.book_name);
            $("#update_category_name").val(book.category_name);
           // $("#update_author_name").val(book.author_name);
            //$("#update_author").val(book.author_name);
            //$('#update_author[value=book.author_id]').attr('selected','selected');

            // jquery selecting the dropdown for author
            var author_id = book.author_id;//console.log(author_id);
                $("select#update_author > option").each(function(){
                    
                    if($(this).val()==author_id){//console.log('match id');
                        $(this).attr("selected","selected"); 
                    }/*else{
                        $("select#update_author").find('option').removeAttr("selected");
                    }*/
            });
                //$("#update_author option).prop("selected", false);

            // jquery selecting the dropdown for Category
            var category_id = book.category_id;console.log(category_id);
                $("select#update_category_name option").each(function(){
                    if($(this).val()==category_id){//console.log('match id');
                        $(this).attr("selected","selected");    
                    }
            });

            $("#update_isbn").val(book.isbn_number);
            $("#update_price").val(book.price);
            $("#update_piece_of_books").val(book.piece_of_books);
            //$("#update_status").val(user.status);
            //user.status='1'?$("#update_status").checked(true):$("#update_status").checked(false);
            // ((user.status == 1) ?$("#update_status").prop('checked', true):$("#update_status").prop('checked', false));
        });
    // Open modal popup

    $("#update_user_modal").modal("show");
}

function UpdateBookDetails() {
    // get values
    var update_book_name = $("#update_book_name").val();
   // var update_category_name = $("#update_category_name").val();alert(update_category_name);
   // var update_author = $("#update_author").val();
    var update_isbn = $("#update_isbn").val();
    var update_price = $("#update_price").val();
    var update_piece_of_books = $("#update_piece_of_books").val();
    // get hidden field value
    var id = $("#hidden_user_id").val();
    //alert(id)
    // Update the details by requesting to the server using ajax
    $.post("ajax/Books/updateBookDetails.php", {
            id: id,
            update_book_name: update_book_name,
           // update_category_name: update_category_name,
           // update_author: update_author,
            update_isbn: update_isbn,
            update_price: update_price,
            update_piece_of_books: update_piece_of_books

        },
        function (data, status) {//alert(data)
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readBookRecords();
        }
    );
}




/**
    Issue Books
**/

function addBookIssueRecord() {
    // get values
    var book_name = $("#book").val();
    var category_name = $("#category").val();
    var author = $("#author").val();
    var author_name = $("#author_name").val();
    var isbn = $("#isbn").val();
    var price = $("#price").val();
    var piece_of_books = $("#piece_of_books").val();
    // Add record
    $.post("ajax/Books/addRecord.php", {//alert(session_name)
        book_name: book_name,
        category_name: category_name,
        author_name: author_name,
        author: author,
        isbn: isbn,
        price: price,
        piece_of_books: piece_of_books,
        created_at: new Date(),
        updated_at: new Date()
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readBookRecords();

        // clear fields from the popup
        $("#book").val("");
        $("#category").val("");
        $("#author_name").val("");
        $("#author").val("");
        $("#isbn").val("");
        $("#price").val("");
        $("#piece_of_books").val("");
    });
}

// READ Book Issue records
function readBookIssueRecords() {
    $.get("ajax/BooksIssue/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function DeleteBookIssueDetails(id) {
    var conf = confirm("Are you sure, do you really want to delete?");
    if (conf == true) {
        $.post("ajax/BooksIssue/deleteBook.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readBookIssueRecords();
            }
        );
    }
}

function GetBookDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/Books/readBookDetails.php", {
            book_id: id
        },
        function (data, status) {// console.log(data);
            // PARSE json data
            var book = JSON.parse(data);console.log(book);
            // Assing existing values to the modal popup fields
            $("#update_book_name").val(book.book_name);
           // bondho $("#update_category_name").val(book.category_name);
           // $("#update_author_name").val(book.author_name);
            //$("#update_author").val(book.author_name);
            //$('#update_author[value=book.author_id]').attr('selected','selected');

            // jquery selecting the dropdown for author
            var author_id = book.author_id;console.log(author_id);
                $("select#update_author option").each(function(){
                    if($(this).val()==author_id){//console.log('match id');
                       // $("#update_author option:selected").removeAttr("selected");

                        $("select#update_author").find('option:selected').removeAttr("selected");
                        $(this).attr("selected","selected");
                    }


                });








            // jquery selecting the dropdown for Category
            var category_id = book.category_id;//console.log(author_id);
                $("select#update_category_name option").each(function(){
                    if($(this).val()==category_id){//console.log('match id');
                        $("select#update_category_name").find('option:selected').removeAttr("selected");
                        $(this).attr("selected","selected");    
                    }
            });

            $("#update_isbn").val(book.isbn_number);
            $("#update_price").val(book.price);
            $("#update_piece_of_books").val(book.piece_of_books);
            //$("#update_status").val(user.status);
            //user.status='1'?$("#update_status").checked(true):$("#update_status").checked(false);
            // ((user.status == 1) ?$("#update_status").prop('checked', true):$("#update_status").prop('checked', false));
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateBookDetails() {
    // get values
    var update_book_name = $("#update_book_name").val();
    var update_category_name = $("#update_category_name").val();
    var update_author = $("#update_author").val();
    var update_isbn = $("#update_isbn").val();
    var update_price = $("#update_price").val();
    var update_piece_of_books = $("#update_piece_of_books").val();
    // get hidden field value
    var id = $("#hidden_user_id").val();
    alert(id)
    // Update the details by requesting to the server using ajax
    $.post("ajax/Books/updateBookDetails.php", {
            id: id,
            update_book_name: update_book_name,
            update_category_name: update_category_name,
             update_author: update_author,
            update_isbn: update_isbn,
            update_price: update_price,
            update_piece_of_books: update_piece_of_books

        },
        function (data, status) {//alert(data)
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readBookRecords();
        }
    );
}


/**
 Users
 **/

/*function addUserRecord() {
    // get values
    var author_name = $("#author").val();

    // Add record
    $.post("ajax/Users/addRecord.php", {//alert(session_name)
        author_name: author_name,
        created_at: new Date(),
        updated_at: new Date()
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readAuthorRecords();

        // clear fields from the popup
        $("#author").val("");
    });
}*/

// READ records
function readUserRecords() {
    $.get("ajax/Users/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function DeleteUser(id) {
    var conf = confirm("Are you sure, do you really want to delete?");
    if (conf == true) {
        $.post("ajax/Users/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readUserRecords();
            }
        );
    }
}

/*function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/Users/readUserDetails.php", {
            id: id
        },
        function (data, status) {//console.log(data);
            // PARSE json data
            var author = JSON.parse(data);//console.log(author)
            // Assing existing values to the modal popup fields
            $("#update_author_name").val(author.author_name);
            //$("#update_status").val(user.status);
            //user.status='1'?$("#update_status").checked(true):$("#update_status").checked(false);
            // ((user.status == 1) ?$("#update_status").prop('checked', true):$("#update_status").prop('checked', false));
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}*/

/*function UpdateUserDetails() {


// get values
    var update_first_name = $("#update_first_name").val();
    var update_last_name = $("#update_last_name").val();
    var update_email = $("#update_email").val();
    var update_phone = $("#update_phone").val();
    var update_password = $("#update_password").val();
    var update_role_name = $("#update_role_name").val();
    var update_discipline = $("#update_discipline").val();
    var update_rollno = $("#update_rollno").val();
    var update_session = $("#update_session").val();
    var update_designation = $("#update_designation").val();
    // get hidden field value
    var id = $("#hidden_user_id").val();
    //alert(id)

    $("#update_user_modal").validate({
        rules: {
            firstname: {
                required: true,
            },
            lastname: {
                required: true,
            },
            image: {
                required: true,
            },
        },
        messages: {
            firstname: {
                required: "Please enter first",
            },
            lastname: {
                required: "Please enter middle",
            },
            image: {
                required: "Please Select logo",
            },
        },
        submitHandler: function (form) {

            // Update the details by requesting to the server using ajax
            $.post("ajax/Users/updateUserDetails.php", {
                    id: id,
                    update_first_name: update_first_name,
                    update_last_name: update_last_name,
                    update_email: update_email,
                    update_phone: update_phone,
                    update_password: update_password,
                    update_role_name: update_role_name,
                    update_discipline: update_discipline,
                    update_rollno: update_rollno,
                    update_session: update_session,
                    update_designation: update_designation,
                },
                function (data, status) {//alert(data)
                    // hide modal popup
                    $("#update_user_modal").modal("hide");
                    // reload Users by using readRecords();
                    readUserRecords();
                }
            );
        }
    });

}
*/

$(document).ready(function () {
    // READ recods on page load


    var url = document.location.href;
    if (url== 'http://localhost/olms/admin/discipline-manage.php' || url== 'http://localhost/olms/admin/discipline-manage.php?success=1' || url== 'http://localhost/olms/admin/discipline-manage.php#') {
      readDisciplineRecords();
    }if(url== 'http://localhost/olms/admin/session-manage.php' || url=='http://localhost/olms/admin/session-manage.php?success=1' || url=='http://localhost/olms/admin/session-manage.php?#') {
        readSessionRecords(); // calling function
    }if(url== 'http://localhost/olms/admin/authors-manage.php' || url=='http://localhost/olms/admin/authors-manage.php?success=1' || url=='http://localhost/olms/admin/authors-manage.php?#') {
        readAuthorRecords(); // calling function
    }if(url== 'http://localhost/olms/admin/books-manage.php' ||  url=='http://localhost/olms/admin/books-manage.php?success=1' || url=='http://localhost/olms/admin/books-manage.php?#') {
        readBookRecords(); // calling function
    }if(url== 'http://localhost/olms/admin/bookissue-manage.php' || url=='http://localhost/olms/admin/bookissue-manage.php?success=1' || url=='http://localhost/olms/admin/bookissue-manage.php?book-issue-available-1=1') {
        readBookIssueRecords(); // calling function
    }if(url== 'http://localhost/olms/admin/users-manage.php' || url=='http://localhost/olms/admin/users-manage.php?success=1' || url=='http://localhost/olms/admin/users-manage.php?fkeyconstraint=1' || url=='http://localhost/olms/admin/users-manage.php?#') {
        readUserRecords(); // calling function
    }

    
    


    
   
    // Pagination initiates
 $.ajax({
 url:"ajax/Sessions/pagination.php",
 type:"POST",
 data:"actionfunction=showData&page=1",
 cache: false,
 success: function(response){

 $('#pagination').html(response);

 }

 });
 $('#pagination').on('click','.page-numbers',function(){
 $page = $(this).attr('href');
 $pageind = $page.indexOf('page=');
 $page = $page.substring(($pageind+5));

 $.ajax({
 url:"ajax/pagination.php",
 type:"POST",
 data:"actionfunction=showData&page="+$page,
 cache: false,
 success: function(response){

 $('#pagination').html(response);

 }

 });
 return false;
 });
});