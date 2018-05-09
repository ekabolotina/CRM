function addCompanyFormCallbackAfter(data) {
    console.log(data);
    data = JSON.parse(data);
    var $form = $('#addCompanyForm');

    if (data.error === 200) {
        showAlert($form, 'Компания успешно создана. Перейдите в &nbsp;<a href="/admin/company/?id='+ data.companyId +'" class="btn btn-success btn-small">Карточку компании</a>', 'success');
        $form.trigger('reset');

        return;
    }

    if (data.error === 203) {
        showAlert($form, 'Указанный e-mail уже используется.');

        return;
    }

    showAlert($form, 'Не удалось создать компанию. Свяжитесь с нами по электронной почте <a href="mailto:dev@swat.one">dev@swat.one</a>');
}
