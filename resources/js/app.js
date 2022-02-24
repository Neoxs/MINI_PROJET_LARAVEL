require('./bootstrap');

const DeleteButton = document.querySelector('.delete-button');
const BookId = document.querySelector('.book-id');
const BookTitle = document.querySelector('.book-title');
const List = document.querySelectorAll('.list-item');

// DELETE STUFF
const PopFromList = () => {
    Delete()
    .then(result => {
        List.forEach(Item => {
            if(Item.innerText == BookTitle.innerText){
                Item.style.opacity = '0';
                setTimeout((e) => {
                    Item.remove()
                }, 1000);
            }
        })
        console.log(result);
    })
    .catch(error => {
        alert('Unsuccessful!');
        console.log(error)
    });
}

const Delete = async() => {

    const Remove = await fetch(`/dashboard/delete/${BookId.textContent}`, {
        method: 'GET'
    });

    return Remove.json();
}

DeleteButton.addEventListener('click', (e) => {
    e.preventDefault();
    PopFromList();
})

const EditButton = document.querySelector('.edit-button');
const Body = document.querySelector('body');

const Edit = async() => {

    console.log(BookId.textContent.trim())

    const edit = await fetch(`/dashboard/edit/${BookId.textContent.trim()}`,{
        method: 'GET'
    })

    return edit.json();
}

const SaveChanges = async(isbn, title, author, price) => {
    
    console.log(document.querySelector('input[name=_token]').value)

    const Save = await fetch(`/dashboard/edit/db/${BookId.textContent.trim()}` , {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            "X-CSRF-Token": document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify({
            'isbn': isbn,
            'title': title,
            'author': author,
            'price': price
        })
    });

    return Save.json();

}

const Input = (InputType, InputName, InputFor, Content) => {
    
    const Input = document.createElement('input');
    Input.setAttribute('type', InputType);
    Input.setAttribute('name', InputName);

    const br = document.createElement('br');

    const Label = document.createElement('label');
    Label.htmlFor = InputFor;
    Label.innerHTML = Content;
    Label.append(
        br,
        Input
    );

    return Label;
}

const Modal = (ISBN, Title, Author, Price) => {
    
    const ModalTitle = document.createElement('h1');
    ModalTitle.innerHTML = 'Editing are we? 🤔';

    const ISBNInput = Input('text', 'isbn', 'isbn' , `New ISBN from ${ISBN}`);
    const TitleInput = Input('text', 'title', 'title' , `New Title from ${Title}`);
    const AuthorInput = Input('text', 'author', 'author' , `New Author from ${Author}`);
    const PriceInput = Input('number', 'price', 'price' , `New Price from ${Price}`);

    const InputGroup = document.createElement('div');
    InputGroup.className = 'container col';
    InputGroup.append(
        ISBNInput,
        TitleInput,
        AuthorInput,
        PriceInput
    );

    const Exit = document.createElement('button');
    Exit.type = 'submit';
    Exit.style.backgroundColor = 'var(--color5)';
    Exit.innerHTML = 'EXIT';
    Exit.addEventListener('click', (e) => {
        e.preventDefault();
        ModalBase.style.opacity = '0';
        setTimeout(() => {
            Body.firstChild.remove();
        }, 1000)
    })

    const Proceed = document.createElement('button');
    Proceed.type = 'submit';
    Proceed.style.backgroundColor = 'var(--color3)';
    Proceed.style.color = "var(--color1)";
    Proceed.innerHTML = 'SAVE CHANGES';
    Proceed.addEventListener('click', (e) => {
        e.preventDefault();
        SaveChanges(ISBNInput.lastChild.value, 
                    TitleInput.lastChild.value, 
                    AuthorInput.lastChild.value,
                    PriceInput.lastChild.value)
        .then(
            result => {
                alert("Edit success!")
                setTimeout(() => {
                    Body.firstChild.remove();
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }, 1500);
            }
        )
        .catch( 
            error => {
                console.log(error);
        })
    })
    
    const ButtonGroup = document.createElement('div');
    ButtonGroup.className = 'modal-button-group container row';
    ButtonGroup.append(
        Proceed,
        Exit
    )

    const EditForm = document.createElement('form');
    EditForm.setAttribute('method', 'post');
    EditForm.className = 'modal-form container col';
    EditForm.append(
        ModalTitle,
        InputGroup,
        ButtonGroup
    );

    const ModalInner = document.createElement('div');
    ModalInner.className = 'container col fh';

    ModalInner.append(
        EditForm
    );

    const ModalBase = document.createElement('div');
    ModalBase.className = 'modal container col fhw';

    ModalBase.append(
        ModalInner
    );

    return ModalBase;
}

EditButton.addEventListener('click', (e) => {
    e.preventDefault();
    Edit()
    .then(({status, book}) => {
        console.log(status);
        const {isbn_no, name, author, price} = book[0];
        Body.prepend(Modal(isbn_no, name, author, price));
    })
    .catch(error => {
        console.log(error);
    })
})
