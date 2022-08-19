$(document).ready(function(){
    console.log('hello');
    let $btnSearch      = $("button#btn-search"); 
    let $btnClearSearch = $("button#btn-clear-search");

    let $inputSearchField = $("input[name=search_field]");
    let $inputSearchValue = $("input[name=search_value]");

    $("a.select-field").click(function(e){
        e.preventDefault(); //Huỷ bỏ event nếu nó có thể huỷ mà không dừng sự lan rộng(propagation) của event tới phần khác.

        let field       = $(this).data("field"); // Lấy giá trị data-field="%s"
        let fieldName   = $(this).html(); // Lấy giá trị html ví dụ 'Search by All'
        $("button.btn-active-field").html(fieldName + '<span class="caret"></span>'); // Cập nhật lại thẻ html vào button
        $inputSearchField.val(field); // gán giá trị value tại input search field
    });

    $btnSearch.click(function(){
        var pathname	    = window.location.pathname; // lấy url cũ '/admin/slider'
        let searchParams    = new URLSearchParams(window.location.search); // lấy giá trị search trên url
        params	            = ['filter_status']; // giá trị muốn giữ lại trên url

        let link            = "";
        $.each(params, function(key, param){ // Tiến hành duyệt qua mảng (each = foreach) params xem searchParans có chứa 'filter_status' hay ko
            if (searchParams.has(param)){ // nếu có thì sẽ gán link => phương thức này để lấy link có filter_status
                link += param + "=" + searchParams.get(param) + "&"; 
            }
        });
        
        let search_field = $inputSearchField.val(); // giá trị lấy được khi chọn ở trên
        let search_value = $inputSearchValue.val(); // giá trị người dùng nhập vào

        if (search_value.replace(/\s+/g, "") == ""){
            alert("Vui lòng nhập giá trị cần tìm!") // nếu không có giá trị nhập vào
        } else {
            window.location.href = pathname + "?" + link + "search_field=" + search_field + "&search_value=" + search_value; // đẩy link lên URL
        }
    });

    $btnClearSearch.click(function(){
        var pathname = window.location.pathname;
        let searchParams = new URLSearchParams(window.location.search);
        params = ['filter_status'];

        let link = "";
        $.each(params, function(key, param){
            if (searchParams.has(param)){
                link += param + "=" + searchParams.get(param) + "&";
            }
        });

        window.location.href = pathname + "?" + link.slice(0, -1);
    });

    $(".btn-delete").on('click', function(){
        if(!confirm("Bạn có chắc muốn xóa phần tử này!"))
            return false;
    });
});