<script>
/*Khởi tạo show / hide tooltip*/
function showTooltip(){
    try{
        $(this).tooltip('show');
        return true;
    }
    catch(err)
    {
        alert('Lỗi: ' + err.stack + '!');
        return false;
    }
};

function hideTooltip(){
    try{
        $(this).tooltip('hide');
        return true;
    }
    catch(err)
    {
        alert('Lỗi: ' + err.stack + '!');
        return false;
    }
};

/*Check if Number include Regex*/
function checkNumberIncludeRegex(s)
{
    try
    {
        var i = 0;
        var countPlus = 0;
        var countSub = 0;
        var countDot = 0;

        if(!(s instanceof String) && !(s instanceof Number) && typeof s !== 'string' && typeof s !== 'number')
            return false;
        else if(s instanceof String || typeof s === 'string')
            for(; i < s.length; ++i)
            {
                switch(s[i])
                {
                    case '0': case '1': case '2': case '3': case '4': case '5': case '6': case '7': case '8': case '9': break;
                    case '.': 
                        if((++countDot) > 1)
                            return false;
                        break;
                    case '-': 
                        if(i || ((++countSub) > 1))
                            return false;
                        break;
                    case '+': 
                        if(i || ((++countPlus) > 1))
                            return false;
                        break;
                    default: return false;
                }
            }
        return true;
    }
    catch(err)
    {
        alert('Lỗi: ' + err.stack + '!');
        return false;
    }
}

/*Check email*/
function checkEmail(email)
{
    try
    {
        var i = 0;
        var dot = 0;
        var ac = 0;
        if(email.indexOf('@') <= 0 || email.indexOf('.') <= 0)
            return false;
        for(; i < email.length; ++i)
            if(i > 0 && i < email.length - 1)
            {
                if(email[i] === '@')
                    ac = ++ac;
                if(email[i] === '.' && ac)
                    dot = ++dot;
                if((email[i] === '@' && email[i - 1] === '.') || (email[i] === '@' && !/^[A-Z0-9]$/i.test(email[i + 1])) || ac > 1 || dot > 1)// sau @ khác chữ và số
                    return false;
            }
            else if(i && (email[i] === '@' || email[i] === '.'))
                return false;
            else if(i && !dot)
                return false;
        return true;
    }
    catch(err)
    {
        alert('Lỗi: ' + err.stack + '!');
        return false;
    }
}

function xhrSetting()
{
    return $.ajaxSettings.xhr();
}

function guiYeuCauThatBai(jqXHR, textStatus, errorThrown, action, countObject, objectStr, deferr = null)
{
    try
    {
        if(countObject > 1)
        {
            if(jqXHR.status == 419)
                throw new TypeError(action + ' các ' + objectStr + ' thất bại!<br>Người dùng không được xác thực (có thể đã đăng xuất hoặc có thể do cookie hoặc session đã bị xoá).<br>Mô tả:<br>' + jqXHR.responseText + '<br>' + textStatus + '<br>' + errorThrown + '<br>');
            else if(jqXHR.status == 500)
                throw new TypeError(action + ' các ' + objectStr + ' thất bại!<br>Đã phát hiện lỗi trên máy chủ phục vụ.<br>Mô tả:<br>' + jqXHR.responseText + '<br>' + textStatus + '<br>' + errorThrown + '<br>');
            else
                throw new TypeError(action + ' các ' + objectStr + ' thất bại!<br>Lỗi server.<br>Mô tả:<br>' + jqXHR.responseText + '<br>' + textStatus + '<br>' + errorThrown + '<br>');
        }
        else if(jqXHR.status == 419)
            throw new TypeError(action + ' ' + objectStr + ' thất bại!<br>Người dùng không được xác thực (có thể đã đăng xuất hoặc có thể do cookie hoặc session đã bị xoá).<br>Mô tả:<br>' + jqXHR.responseText + '<br>' + textStatus + '<br>' + errorThrown + '<br>');
        else if(jqXHR.status == 500)
            throw new TypeError(action + ' ' + objectStr + ' thất bại!<br>Đã phát hiện lỗi trên máy chủ phục vụ.<br>Mô tả:<br>' + jqXHR.responseText + '<br>' + textStatus + '<br>' + errorThrown + '<br>');
        else
            throw new TypeError(action + ' ' + objectStr + ' thất bại! Lỗi server.<br>Mô tả:<br>' + jqXHR.responseText + '<br>' + textStatus + '<br>' + errorThrown + '<br>');
        if(deferr)
            deferr.resolve();
        return true;
    }
    catch(err)
    {
        alert('Lỗi: ' + err.stack + '!');
        if(deferr)
            deferr.resolve();
        return false;
    }
}

/*Sắp xếp lại index của các bản ghi ghi xoá hoặc thêm mới */
function reOrderRecords(table, colIndex)
{
    try
    {
        var indexes = table.DataTable().rows().indexes();
        var i = 0;
        for(; i < indexes.length; ++i)
        {
            table.dataTable().fnUpdate((i < 10 ? (i + 1) : i), i, colIndex, false, false);
        }
        return true;
    }
    catch(err)
    {
        alert('Lỗi: ' + err.stack + '!');
        return false;
    }
}

/*Lấy số lượng checkbox trạng thái check trong datasource*/
function getLengthChkCheck(table, iCol)
{
    var data = table.DataTable().rows().data();
    var i = 0;
    var countCheck = 0;
    for(; i < data.length; ++i)
        if($(data[i][iCol]).prop('checked'))
            countCheck++;
    return countCheck;
}

/*Cập nhật trạng thái check cho checkbox trong datasource*/
function updateCheckState(table, iRow, iCol, summary, state)
{
    var data = table.DataTable().rows().data();
    var i = 0;
    var chk = null;
    if(summary)
        for(; i < data.length; ++i)
        {
            chk = $(data[i][iCol]).attr('checked', state);
            table.dataTable().fnUpdate(chk[0].outerHTML, i, iCol, false, false);
        }
    else
    {
        chk = $(data[iRow][iCol]).attr('checked', state);
        table.dataTable().fnUpdate(chk[0].outerHTML, iRow, iCol, false, false);
    }
}

/*Lấy danh sách checkbox checked*/
function getChkCheck(table, iCol)
{
    var results = [];
    var data = table.DataTable().rows().data();
    var i = 0;
    var chk = null;
    for(; i < data.length; ++i)
    {
        chk = $(data[i][iCol]);
        if(chk.prop('checked'))
            results.push({'chk': chk, 'idx': i});
    }
    return results;
}

/*Lấy checkbox theo index*/
function getCheckBoxFromDataTable(table, iCol, index)
{
    var data = table.DataTable().row(index).data();
    if(data)
        return $(data[iCol]);
    else
        return null;
}

/*Lấy dữ liệu trên dòng*/
function getRowData(table, idx)
{
    var data =  table.DataTable().row(idx).data();
    if(data) return data; return null;
}

/*Lấy chỉ mục để xoá*/
function getIndexToDel(table, iCol, obj)
{
    var data = table.DataTable().rows().data();
    var i = 0;
    for(; i < data.length; ++i)
        if($(data[i][iCol]).attr(obj.property) === obj.value)
            return i;
    return -1;
}

/*Xử lý click lên vùng chứa checkbox để trigger check (trên table)*/
function clickParentToCheck($this, type, table, callBackP, callBackC)
{
    var child = $this.children();
    var def = null;
    var defs = [];
    if(child.attr('data-checkbox-' + type) === 'p')
    {
        if(child.prop('checked'))
            child.prop('checked' , false);
        else
            child.prop('checked' , true);
        callBackP(child);
    }
    else
    {
        def = $.Deferred();
        defs.push(def.promise());
        if(child.prop('checked'))
            updateCheckState(table, table.DataTable().row($this.closest('tr')).index(), 0, false, false);
        else
            updateCheckState(table, table.DataTable().row($this.closest('tr')).index(), 0, false, true);
        def.resolve();
        $.when.apply($, defs).then(function(){
            callBackC();
        });
    }
}

/*Xử lý trigger checkbox (trên table)*/
function clickToCheck(e, $this, type, table, callBackP, callBackC)
{
    var def = null;
    var defs = [];
    e.stopPropagation();
    if($this.attr('data-checkbox-' + type) === 'p')
        callBackP($this);
    else
    {
        def = $.Deferred();
        defs.push(def.promise());
        if($this.prop('checked'))
            updateCheckState(table, table.DataTable().row($this.closest('tr')).index(), 0, false, true);
        else
            updateCheckState(table, table.DataTable().row($this.closest('tr')).index(), 0, false, false);
        def.resolve();
        $.when.apply($, defs).then(function(){
            callBackC();
        });
    }
}

/*Sắp xếp các phần tử trong table theo format*/
function sortElementTable(tableId, tableName, _order, _colDefs, divideCol, expBtn, expBtnIdx = 0, categoryCls = false)
{
    var filter = null;
    var btnGroupExport = null;
    var divGroupButton = null;
    var btnParent2 = null;
    var btnParent3 = null;
    var btnSC = null;
    var btnEx = null;
    var btnPDF = null;
    var btnGroupExportSub = null;
    var btnSub = null;
    var table = $("#" + tableId);
    console.log("init_DataTables_" + tableName);
    if(expBtn)
    {
        table.dataTable({
            order: _order,
            columnDefs: _colDefs,
            dom:"Blfrtip",
            buttons:[
                {extend:"copy",className:"btn-sm"},
                {extend:"csv",className:"btn-sm"},
                {extend:"print",className:"btn-sm"}],
            responsive:!1,
            keys:!0
        });
        /*Sắp xếp các nút sao chép, xuất excel và in pdf*/
        filter = $('#table__id__' + tableName + '_filter');
        $('#table__id__' + tableName + '_wrapper').prepend('<div class="row marginBottom10 div__class__group_button' + (categoryCls ? ('_' + tableName) : '') + '"></div>');
        divGroupButton = $('.div__class__group_button' + (categoryCls ? ('_' + tableName) : ''));
        filter.next().remove();
        if(divideCol)
        {
            divGroupButton.prepend('<div class="col-sm-4" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1"><div class="row"><div class="col-sm-4" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1_1"></div><div class="col-sm-8" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1_2"></div></div></div>');
            $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1_1').append($('#div__id__button_group_' + tableName));
            $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1_2').append($('#table__id__' + tableName + '_length'));
        }
        else
        {
            divGroupButton.prepend('<div class="col-sm-4" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1"></div>');
            $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1').append($('#table__id__' + tableName + '_length'));
        }
        $('<div class="col-sm-4" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_2"></div>').insertAfter('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1');
        btnParent2 = $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_2');
        $('<div class="col-sm-4" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_3"></div>').insertAfter('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_2');
        btnParent3 = $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_3');
        btnParent3.append(filter);
        filter.css('float', 'left');
        divGroupButton.append(btnParent2);
        divGroupButton.append(btnParent3);
        btnGroupExport = $('[data-div-id="btnGroupExport"]');
        btnParent2.append(btnGroupExport[expBtnIdx]);
        btnGroupExportSub = $(btnGroupExport[expBtnIdx]).children();
        /*Reformat btutton copy, export excel and export pdf*/
        /*Copy button*/
        $(btnGroupExportSub[0]).attr('data-button-id', 'saoChep' + (categoryCls ? ('_' + tableName) : ''));
        btnSC = $('[data-button-id="saoChep' + (categoryCls ? ('_' + tableName) : '') + '"]');
        btnSub = $(btnSC.children()[0]);
        btnSC.removeClass('btn-default');
        btnSC.removeClass('btn-sm');
        btnSC.addClass('btn-success');
        btnSC.attr('data-toggle', 'tooltip');
        btnSC.attr('data-original-title', btnSub.html());
        btnSC.append('<i class="fa fa-copy"></i>');
        btnSub.remove();
        btnSC.attr('data-placement', 'left');
        /*Export excel button*/
        $(btnGroupExportSub[1]).attr('data-button-id', 'excel' + (categoryCls ? ('_' + tableName) : ''));
        btnEx = $('[data-button-id="excel' + (categoryCls ? ('_' + tableName) : '') + '"]');
        btnSub = $(btnEx.children()[0]);
        btnEx.removeClass('btn-sm');
        btnEx.removeClass('btn-default');
        btnEx.addClass('btn-info');
        btnEx.addClass('_btn-sm');
        btnEx.attr('data-toggle', 'tooltip');
        btnEx.attr('data-original-title', btnSub.html());
        btnEx.append('<i class="fa fa-file-excel-o"></i>');
        btnSub.remove();
        btnEx.attr('data-placement', 'left');
        /*Export pdf button*/
        $(btnGroupExportSub[2]).attr('data-button-id', 'pdf' + (categoryCls ? ('_' + tableName) : ''));
        btnPDF = $('[data-button-id="pdf' + (categoryCls ? ('_' + tableName) : '') + '"]');
        btnSub = $(btnPDF.children()[0]);
        btnPDF.removeClass('btn-sm');
        btnPDF.removeClass('btn-default');
        btnPDF.addClass('btn-warning');
        btnPDF.addClass('_btn-sm');
        btnPDF.attr('data-toggle', 'tooltip');
        btnPDF.attr('data-original-title', btnSub.html());
        btnPDF.append('<i class="fa fa-file-pdf-o"></i>');
        btnSub.remove();
        btnPDF.attr('data-placement', 'left');
    }
    else
    {
        table.dataTable({
            order: _order,
            columnDefs: _colDefs,
            responsive:!1,
            keys:!0
        });
        /*Sắp xếp các nút sao chép, xuất excel và in pdf*/
        filter = $('#table__id__' + tableName + '_filter');
        $('#table__id__' + tableName + '_wrapper').prepend('<div class="row marginBottom10 div__class__group_button' + (categoryCls ? ('_' + tableName) : '') + '"></div>');
        divGroupButton = $('.div__class__group_button' + (categoryCls ? ('_' + tableName) : ''));
        filter.next().remove();
        if(divideCol)
        {
            divGroupButton.prepend('<div class="col-sm-4" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1"><div class="row"><div class="col-sm-4" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1_1"></div><div class="col-sm-8" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1_2"></div></div></div>');
            $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1_1').append($('#div__id__button_group_' + tableName));
            $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1_2').append($('#table__id__' + tableName + '_length'));
        }
        else
        {
            divGroupButton.prepend('<div class="col-sm-4" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1"></div>');
            $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1').append($('#table__id__' + tableName + '_length'));
        }
        $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1_1').append($('#div__id__button_group_' + tableName));
        $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1_2').append($('#table__id__' + tableName + '_length'));
        $('<div class="col-sm-4" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_2"></div>').insertAfter('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_1');
        btnParent2 = $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_2');
        $('<div class="col-sm-4" id="div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_3"></div>').insertAfter('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_2');
        btnParent3 = $('#div__id__div_button_parent' + (categoryCls ? ('_' + tableName) : '') + '_3');
        btnParent3.append(filter);
        filter.css('float', 'left');
        divGroupButton.append(btnParent2);
        divGroupButton.append(btnParent3);
        divGroupButton.next().remove();
    }
    table.css('position','');table.css('width','');
}
</script>