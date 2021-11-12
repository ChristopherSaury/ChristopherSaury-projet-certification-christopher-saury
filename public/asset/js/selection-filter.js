window.onload = () => {
    const filterForm = document.querySelector("#categories-filter");
    document.querySelectorAll("#categories-filter input").forEach(input =>{
        input.addEventListener('change', () => {
            const form = new FormData(filterForm);

            const Params = new URLSearchParams;

            form.forEach((value, key) => {
                Params.append(key, value);
            });
            const Url = new URL(window.location.href);
            
            fetch(Url.pathname + "?" + Params.toString() + "&ajax=1",{
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
                }).then(response => {
                    console.log(response)
            }).catch(e => alert(e))
        })
    }) 
}