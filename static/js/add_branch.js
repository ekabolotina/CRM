function addBranchFormCallbackAfter(data){
    console.log(data);
    data = JSON.parse(data);
    var $form = $('#addBranchForm'),
        $branchesList = $('#branchesList'),
        branchesListLastIndex = parseInt($branchesList.find('tr').last().find('td').first().text());
    if(data.error == 200){
        showAlert($form, 'Филиал успешно добавлен.', 'success');
        $form.trigger('reset');
        $('#branchesList').append('<tr><td>'+ (branchesListLastIndex+1) +'</td><td>'+ data.branchName +'</td></tr>');
    }else
        showAlert($form, 'Не удалось создать филиал. Свяжитесь с нами по электронной почте <a href="mailto:dev@swat.one">dev@swat.one</a>');
}
