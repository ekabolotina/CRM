function addBranchFormCallbackAfter(data) {
    data = JSON.parse(data);
    var $form = $('#addBranchForm'),
        $branchesList = $('#branchesList'),
        $companyInfoBranchesCount = $('#companyInfoBranchesCount');

    if (data.error === 200) {
        if ($branchesList.length) {
            var $branchesListLines = $branchesList.find('tr'),
                branchesListLastIndex = $branchesListLines.length ? parseInt($branchesList.find('tr').last().find('td').first().text()) : 0;

            $branchesList.append('<tr><td>'+ (branchesListLastIndex+1) +'</td><td>'+ data.branchName +'</td></tr>');
            if ($companyInfoBranchesCount.length) {
                $companyInfoBranchesCount.text(branchesListLastIndex+1);
            }
        }
        showAlert($form, 'Филиал успешно добавлен.', 'success');
        $form.trigger('reset');

        return;
    }

    if (data.error === 203) {
        showAlert($form, 'Указанный e-mail уже используется.');

        return;
    }

    showAlert($form, 'Не удалось создать филиал. Свяжитесь с нами по электронной почте <a href="mailto:dev@swat.one">dev@swat.one</a>');
}
