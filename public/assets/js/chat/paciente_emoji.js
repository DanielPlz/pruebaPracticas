document.addEventListener('DOMContentLoaded', () =>  {
    const button = document.querySelector('#emoji-button');
    const caja = document.querySelector('.input-group');
    const textChat = document.querySelector('#txtChat');
    const picker = new EmojiButton({
        autoHide: false,
    });
    picker.on('emoji', emoji => {
        textChat.value += emoji;
    });
    $('#emoji-button').on('click', () => {
        $('.wrapper').addClass('emojimodal');
        console.log(picker);
        picker.togglePicker(caja);
    });   
});