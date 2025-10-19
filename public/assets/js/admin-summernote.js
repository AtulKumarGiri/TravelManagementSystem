// public/js/admin-summernote.js
console.log('Admin Summernote JS loaded');
document.addEventListener('DOMContentLoaded', function() {
    $('#summernote').summernote({
        height: 500, // editor height
        placeholder: 'Write page content here...',
        focus: true,
        toolbar: [
            ['style', ['style']],                   
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],                   
            ['para', ['ul', 'ol', 'paragraph', 'height']], 
            ['table', ['table']],                   
            ['insert', ['link', 'picture', 'video', 'hr', 'file']], 
            ['view', ['fullscreen', 'codeview', 'help']],          
            ['undo', ['undo', 'redo']],             
            ['misc', ['print', 'save', 'preview']]  
        ],
        popover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'floatLeft', 'floatRight', 'floatNone', 'removeMedia']],
                ['link', ['linkDialogShow']],
                ['custom', ['imageAttributes']],
            ],
            link: [
                ['link', ['linkDialogShow', 'unlink']]
            ],
            table: [
                ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                ['delete', ['deleteRow', 'deleteCol', 'deleteTable']]
            ],
            air: [
                ['color', ['color']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']]
            ]
        }
    });
});
