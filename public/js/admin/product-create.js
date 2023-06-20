let uploadedDocumentMap = {};

Dropzone.options.documentDropzone = {
    url: getStoreProductMediaRoute,
    maxFilesize: 5, // MB
    acceptedFiles: 'image/*',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (file, response) {
        if (response.success === true) {
            $('form').append('<input type="hidden" name="document" value="' + response.name + '">');
            uploadedDocumentMap[file.name] = response.name
        } else if (response.success === false) {
            file.previewElement.classList.add("dz-error");
        }
    },
    removedfile: function (file) {

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: getRemoveProductMediaRoute,
            type: "POST",
            data: {"file": JSON.parse(file.xhr.response).name},
            error: function (error) {
                alert(error);
            },
            success: function (response) {
                file.previewElement.remove();
                var name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document"][value="' + name + '"]').remove();
            }
        });

    },
    init: function () {

        if (project.length > 0) {
            var files = project;
            for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file);
                file.previewElement.classList.add('dz-complete');
                $('form').append('<input type="hidden" name="document" value="' + file.file_name + '">')
            }
        }
    }
};


// category selection
$("#category-select").change(function () {
    let category = $('option:selected', this).attr('data-slug');
console.log(category);
    if (category.length === 0) {
        $('#sub-category-div').addClass('d-none');
        $('#sub-category-select').empty();
        return false;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "GET",
        url: getSubCatRoute + '/' + category,
        error: function (error) {
            alert(error);
        }
    }).done(function (data) {
        $('#sub-category-div').removeClass('d-none');

        $('#sub-category-select').empty();

        $.each(data.data, function (i, item) {
            $('#sub-category-select').append($('<option>', {
                value: item.id,
                text: item.title
            }));
        });
    });
});
