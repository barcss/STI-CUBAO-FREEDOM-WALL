const content = $('.tab_content');
const menu = $('.tab_menu');

content.on('click', (e)=>{
    $('#col1').addClass('d-none')
    $('#col1').removeClass('d-block')

    $('#content_container').addClass('d-block')
    $('#content_container').removeClass('d-none')
})

menu.on('click', (e)=>{
    $('#col1').addClass('d-block')
    $('#col1').removeClass('d-none')

    $('#content_container').addClass('d-none')
    $('#content_container').removeClass('d-block')
})

$('button[name="filter"]').on('click', (e)=>{
     $('#col1').addClass('d-none')
    $('#col1').removeClass('d-block')

    $('#content_container').addClass('d-block')
    $('#content_container').removeClass('d-none')
})