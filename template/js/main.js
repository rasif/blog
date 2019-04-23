const onWindowLoad = () =>
{
    /* Remove preloader element */

    const clearPreloader = () =>
    {
        const preloader = document.querySelector('.preloader');

        setTimeout(() => preloader.remove(), 700);
    };

    clearPreloader();

    /* Show search */

    const searchIcon = document.querySelector('.search__icon');
    const searchInput = document.querySelector('.search__input');

    const onSearchIconClick = () =>
    {
        searchInput.classList.toggle('search__input-passive');

        if (!searchInput.classList.contains('search__input-passive'))
            searchInput.focus();
    };

    searchIcon.addEventListener('click', onSearchIconClick);

    /* By clicking on the document, to hide search */

    const onDocumentClick = (event) =>
    {
        if (event.target.classList.contains('search__input'))
            return;

        if (event.target.classList.contains('search__icon'))
            return;

        if (!searchInput.classList.contains('search__input-passive'))
        {
            onSearchIconClick();
        }
    };

    document.addEventListener('click', onDocumentClick);

    /* Remove scroll from body element */

    const removeScrollFromBody = () => document.body.classList.toggle('body-scroll');

    /* Show modal block */

    const registerButton = document.querySelector('.header__register');
    const signInButton = document.querySelector('.header__sign');

    const modal = document.querySelector('.modal');
    const modalRegistration = document.querySelector('.modal__registration');
    const modalAuthorization = document.querySelector('.modal__authorization');

    const showRegistrationModal = () =>
    {
        modalRegistration.style.display = 'block';
        modalAuthorization.style.display = "none";
    };

    const showAuthorizationModal = () =>
    {
        modalAuthorization.style.display = "block";
        modalRegistration.style.display = 'none';
    };

    const showModal = () =>
    {
        modal.style.display = "block";
        setTimeout(() => modal.classList.add('modal-active'), 20);

        removeScrollFromBody();
    };

    const onRegisterButtonClick = () =>
    {
        showModal();
        showRegistrationModal();
    };

    const onSignInButtonClick = () =>
    {
        showModal();
        showAuthorizationModal();
    };

    if (registerButton)
        registerButton.addEventListener('click', onRegisterButtonClick);

    if (signInButton)
        signInButton.addEventListener('click', onSignInButtonClick);

    const modalSignInButton = document.querySelector('.modal__signIn');
    const modalRegisterButton = document.querySelector('.modal__register');

    const onModalSignInButtonClick = () => showAuthorizationModal();

    const onModalRegisterButton = () => showRegistrationModal();

    if (modalSignInButton)
        modalSignInButton.addEventListener('click', onModalSignInButtonClick);
    if (modalRegisterButton)
        modalRegisterButton.addEventListener('click', onModalRegisterButton);

    /* Hide modal block */

    const modalCloseButton = document.querySelector('.modal__close');

    const onModalCloseButtonClick = () =>
    {
        modal.classList.remove('modal-active');

        setTimeout(() => modal.style.display = "", 300);

        removeScrollFromBody();
    };

    const onModalClick = (event) =>
    {
        if (event.target.matches('.modal'))
        {
            onModalCloseButtonClick();
        }
    };

    if (modalCloseButton)
        modalCloseButton.addEventListener('click', onModalCloseButtonClick);
    if (modal)
        modal.addEventListener('click', onModalClick);

    /* Scrolling down? Show menu */

    const headerMenu = document.querySelector('.header__menu');
    const getPositionOfElement = (element) => element.getBoundingClientRect().y + window.scrollY;
    const y = getPositionOfElement(headerMenu);

    const onWindowScroll = () =>
    {        
        if (window.scrollY > y)
        {
            headerMenu.classList.add('header__menu-active');
        }
        else
        {
            headerMenu.classList.remove('header__menu-active');
        }
    };

    window.addEventListener('scroll', onWindowScroll);

    /* ObjectFit */

    if('objectFit' in document.documentElement.style === false) 
    {
        var container = document.getElementsByClassName('post__image');

        for(var i = 0; i < container.length; i++) 
        {
            var imageSource = container[i].querySelector('img').src;

            container[i].querySelector('img').style.display = 'none';
            container[i].style.backgroundSize = 'cover';
            container[i].style.backgroundImage = 'url(' + imageSource + ')';
            container[i].style.backgroundPosition = 'center center';
        }
    }

    /* Show message */

    const messageElement = document.querySelector('.message');
    const messageTextElement = document.querySelector('.message__text');
    const messageCloseElement = document.querySelector('.message__close');
    let hideMessageTimeout;

    const hideMessage = () =>
    {
        if (messageElement.classList.contains('message-active'))
        {
            messageElement.classList.remove('message-active');
            setTimeout(() => messageElement.style.display = "none", 300);
        }
    };

    const showMessage = (message) =>
    {
        messageElement.style.display = "block";
        messageTextElement.textContent = message;

        setTimeout(() => messageElement.classList.add('message-active'), 20);
        hideMessageTimeout = setTimeout(() => hideMessage(), 1500);
    };

    const onMessageCloseElementClick = () =>
    {
        clearTimeout(hideMessageTimeout);
        hideMessage();
    };

    messageCloseElement.addEventListener('click', onMessageCloseElementClick);

    /* Register using ajax */

    const getParams = (object) =>
    {
        const params = Object.keys(object).map(key => `${encodeURIComponent(key)} = ${encodeURIComponent(data[key])}`).join('&');
    
        return params;
    };

    const sendPostAJAX = (url, data, success) =>
    {
        const params = typeof data === 'string' ? data : getParams(data);

        const xml = new XMLHttpRequest();

        xml.open('POST', url, true);

        xml.onreadystatechange = () =>
        {
            if (xml.readyState === 4 && xml.status === 200)
            {
                success(xml.responseText);
            }        
        };

        xml.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xml.send(params);
    };

    const formRegisterButton = document.querySelector('.form__register');
    const formAuthorizeButton = document.querySelector('.form__authorize'); 

    const clearForm = (form) =>
    {
        for (let i = 0; i < form.length - 1; i++)
            form[i].value = "";
    };

    const getFormValues = (form) =>
    {
        const values = {};

        for (let i = 0; i < form.length - 1; i++)
            values[form[i].name] = form[i].value;
            
        return values;
    };

    const onFormRegisterButtonClick = (event) =>
    {
        event.preventDefault();

        const form = formRegisterButton.closest('.form');
        const {login, password, email} = getFormValues(form);

        sendPostAJAX("/user/register", `login=${login}&password=${password}&email=${email}`, (response) =>
        {
            if (response === "1")
            {
                showAuthorizationModal();
                clearForm(form);
            }
            else
                showMessage(response);    
        });
    };

    const onFormAuthorizeButtonClick = (event) =>
    {
        event.preventDefault();

        const form = formAuthorizeButton.closest('.form');
        const {login, password} = getFormValues(form);

        sendPostAJAX(`/user/authorize`, `login=${login}&password=${password}`, (response) =>
        {
            if (response === "1")
                location.href = "/";
            else
                showMessage(response);    
        });    
    };

    if (formRegisterButton)
        formRegisterButton.addEventListener('click', onFormRegisterButtonClick);
    if (formAuthorizeButton)
    formAuthorizeButton.addEventListener('click', onFormAuthorizeButtonClick);

    /* Edit submit */

    const editSubmit = document.querySelector('.edit__submit');

    const onEditSubmitClick = (event) =>
    {
        event.preventDefault();
        
        const form = editSubmit.closest('.edit');
        const {title, text} = getFormValues(form);

        sendPostAJAX(`${location.origin}/post/edited`, `title=${title}&text=${text}&postid=${editSubmit.dataset.id}`, (response) =>
        {
            if (response === "1")
                showMessage("Successfully");    
            else
                showMessage(response);    
        });
    };

    if (editSubmit)
        editSubmit.addEventListener('click', onEditSubmitClick);

    /* Add submit */

    const addSubmit = document.querySelector('.edit__add');

    const onAddSubmitClick = (event) =>
    {
        event.preventDefault();
        
        const form = addSubmit.closest('.edit');
        const {title, text, category} = getFormValues(form);

        if (!title.length || !text.length)
        {
            showMessage("Type all fields");  
            return;
        }

        sendPostAJAX(`${location.origin}/post/added`, `title=${title}&text=${text}&category=${category}`, (response) =>
        {
            if (response === "1")
            {
                showMessage("Successfully");
                location.href = "/";  
            }  
            else
                showMessage(response);    
        });
    };

    if (addSubmit)
    addSubmit.addEventListener('click', onAddSubmitClick);
};

window.addEventListener('load', onWindowLoad);