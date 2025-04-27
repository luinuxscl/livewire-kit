<script>
function setLocaleCookie(lang) {
    document.cookie = 'locale=' + lang + ';path=/;max-age=31536000';
}

document.addEventListener('livewire:language-switched', function(e) {
    if(e.detail && e.detail[0]) {
        localStorage.setItem('locale', e.detail[0]);
        setLocaleCookie(e.detail[0]);
        window.location.reload();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var backendLocale = '{{ app()->getLocale() }}';
    var storedLocale = localStorage.getItem('locale');
    if(storedLocale && storedLocale !== backendLocale) {
        setLocaleCookie(storedLocale);
        window.location.reload();
    }
});
</script>
