var secondsToSave = 0;

var notes;
const noteCardHolder1 = document.getElementById('note-card-holder-1');
const noteCardHolder2 = document.getElementById('note-card-holder-2');
const noteCardHolder3 = document.getElementById('note-card-holder-3');
const noteCardHolder4 = document.getElementById('note-card-holder-4');
const noNotesFound = document.getElementById('no-notes-found');


checkIfNoNotes(); // check on load

//pamagat is title, but is taken so fuck it
function generateNewNoteCard(id, pamagat, isArchived){
    const noteCard = document.createElement('div');
    noteCard.classList.add('w-100', 'shadow-1-strong', 'rounded-card', 'mb-4', 'note-card');
    noteCard.setAttribute("card-id", id );
    noteCard.setAttribute("is-archived", isArchived );
    
    const deleteHolder = document.createElement('div');
    deleteHolder.classList.add('delete-holder');
    
    const deleteButton = document.createElement('button');
    deleteButton.classList.add('delete-button');
    if(isArchived == "true"){
        deleteButton.title = "Permanently Delete.";
    } else{
        deleteButton.title = "Move to Archived Notes.";
    }
    deleteButton.addEventListener('click', () => deleteNote(noteCard));
    
    const deleteIcon = document.createElement('i');
    deleteIcon.classList.add('bi', 'bi-trash3', 'button-i');
    
    deleteButton.appendChild(deleteIcon);
    deleteHolder.appendChild(deleteButton);

    const recoverHolder = document.createElement('div');
    recoverHolder.classList.add('recover-holder');
    recoverHolder.classList.add('hide');
    if(isArchived == 'true') recoverHolder.classList.remove('hide');
    
    const recoverButton = document.createElement('button');
    recoverButton.classList.add('recover-button');
    recoverButton.title = "Recover Note.";
    recoverButton.addEventListener('click', () => recoverNote(noteCard));
    
    const recoverIcon = document.createElement('i');
    recoverIcon.classList.add('bi', 'bi-arrow-return-left', 'button-i');

    recoverButton.appendChild(recoverIcon);
    recoverHolder.appendChild(recoverButton);
    
    const title = document.createElement('div');
    
    const titleSpan = document.createElement('span');
    titleSpan.contentEditable = true;
    titleSpan.classList.add('note-title');
    titleSpan.textContent = pamagat;
    
    title.appendChild(titleSpan);
    
    const listHolder = document.createElement('ul');
    listHolder.classList.add('list-group', 'bg-transparent');
    
    const list = document.createElement('li');
    list.classList.add('list-group-item', 'bg-transparent', 'border-0', 'inactive');
    
    const button = document.createElement('button');
    button.classList.add('btn', 'btn-dark', 'bg-transparent', 'border-0', 'p-0', 'new-list');
    button.innerHTML = "&nbsp; +  Add new item to list. &nbsp;"
    button.addEventListener('click', () => addNewListItem(noteCard,"","true"));
    
    list.appendChild(button);
    listHolder.appendChild(list);
    noteCard.appendChild(deleteHolder);
    noteCard.appendChild(recoverHolder);
    noteCard.appendChild(title);
    noteCard.appendChild(listHolder);
    
    noteCardHolder1.insertBefore( noteCard, noteCardHolder1.firstChild);
    
    if(isMobileDevice()) {
        console.log("mobile");
        checkIfNoNotes();
        return noteCard;
    };
    
    const noteCards = document.querySelectorAll('.note-card');
    
    noteCards.forEach(oldNoteCard => {
        if(oldNoteCard != noteCard){
            //moveToOtherHolder(noteCard);
            moveToNextHolder(oldNoteCard)
        }
        });
    
    checkIfNoNotes();
    return noteCard;
}

function checkIfNoNotes(){
    
    var notes = document.querySelectorAll('.note-card.note-card:not(.hide)');
    
    if (notes.length == 0){
        noNotesFound.classList.remove('hide');
    }else{
        noNotesFound.classList.add('hide');
    }


}
function refreshNotesUI() {

    clearNoteCards();
    fetchNotes("index");
}

function clearNoteCards() {
    noteCardHolder1.innerHTML = '';
    noteCardHolder2.innerHTML = '';
    noteCardHolder3.innerHTML = '';
    noteCardHolder4.innerHTML = '';
}

function addNewNote(){
    
    addTimer(generateNewNoteCard(-1,"", "true")); // fix
    
    checkIfNoNotes();
}


function isMobileDevice() {
    return window.innerWidth <= 990;
}

function moveToNextHolder(noteCard) {
    const holders = [noteCardHolder1, noteCardHolder2, noteCardHolder3, noteCardHolder4];
  
    // Find the index of the current holder
    const currentHolderIndex = holders.findIndex(holder => holder.contains(noteCard));
  
    // Calculate the index of the next holder
    const nextHolderIndex = (currentHolderIndex + 1) % holders.length;
  
    // Move the note card to the next holder
    holders[nextHolderIndex].appendChild(noteCard);
  }


function addNewListItem(noteCard, content, isActive) {
    const addButton = noteCard.querySelector('.new-list');
    const addButtonParent = addButton.parentNode;
    
    const newItem = document.createElement('li');
    newItem.classList.add('list-group-item', 'bg-transparent', 'border-0');
    
    const checkbox = document.createElement('input');
    checkbox.classList.add('form-check-input', 'me-1');
    checkbox.type = 'checkbox';
    
    if(isActive == "true"){
        checkbox.checked = false;
    } else{
        checkbox.checked = true;
        newItem.classList.add('checked');
    }
    
    checkbox.ariaLabel = '...';
    checkbox.addEventListener('change', () => toggleCheckedClass(checkbox));
    
    const textSpan = document.createElement('span');
    textSpan.classList.add('text-after-checkbox');
    textSpan.contentEditable = 'true';
    textSpan.innerHTML = content;
    textSpan.addEventListener('keydown', (event) =>removeList(event, newItem, textSpan) );
    
    newItem.appendChild(checkbox);
    newItem.appendChild(textSpan);
    
    addButton.parentNode.parentNode.insertBefore(newItem, addButtonParent);
    
    textSpan.focus();
}


function toggleCheckedClass(checkbox) {
    const listItem = checkbox.closest('.list-group-item');

    if (checkbox.checked) {
        listItem.classList.add('checked');
    } else {
        listItem.classList.remove('checked');
    }
}

function removeList(event, item, span) {
    if (span.textContent.trim() === '' && event.key === 'Backspace') item.classList.toggle('hide');
}

function deleteNote(noteCard) {
    noteCard.classList.toggle('hide');
    
    var isArchived = noteCard.getAttribute("is-archived");
    var id = noteCard.getAttribute("card-id");
    
    let formData = new FormData();
    formData.append('id', id);
    formData.append('isArchived', isArchived);
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'archiveNoteAction.php', true);
    xhr.onload = function () {
        
        noteCard.setAttribute("is-archived", this.responseText);
        noteCard.querySelector('.recover-holder').classList.remove("hide");
        refreshNotesUI();
    };
    
    xhr.send(formData);
    checkIfNoNotes();
}



function recoverNote(noteCard) {
    noteCard.classList.toggle('hide');
    
    var id = noteCard.getAttribute("card-id");
    
    let formData = new FormData();
    formData.append('id', id);
    formData.append('isRecover', "1");
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'archiveNoteAction.php', true);
    xhr.onload = function () {
        
        noteCard.setAttribute("is-archived", this.responseText);
        noteCard.querySelector('.recover-holder').classList.add("hide");
    };
    
    xhr.send(formData);   
    checkIfNoNotes();
}

//onload, called on specific pages
function fetchNotes(pageName) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'getNotesAction.php', true);
    xhr.onload = function () {
        //console.log(this.responseText);
        if (this.status === 200) {
            notes = JSON.parse(this.responseText);
            notes.forEach(function (note) {
                var id = note.id;
                var title = note.title;
                var content = note.content;
                var isArchived = note.isArchived;
                //console.log(id + " " + title + " " + content);
            
                if (pageName === "index" && isArchived == "false") {
                    var newNoteCard = generateNewNoteCard(id, title, isArchived);
                    
                    var listItems = content.split(' | ');
                    listItems.forEach(function (item) {
                        var parts = item.split(': ');
                        var itemName = parts[0];
                        var isActive = parts[1];
                        addNewListItem(newNoteCard, itemName, isActive)
                    });

                    addTimer(newNoteCard);
                }
                
                if (pageName === "archived" && isArchived == "true") {
                    var newNoteCard = generateNewNoteCard(id, title, isArchived);
                    
                    var listItems = content.split(' | ');
                    listItems.forEach(function (item) {
                        var parts = item.split(': ');
                        var itemName = parts[0];
                        var isActive = parts[1];
                        addNewListItem(newNoteCard, itemName, isActive)
                    });

                    addTimer(newNoteCard);
                }
            
            });
        
        } else {
            console.error('Error fetching notes:', this.statusText);
        }
    };
    
    xhr.send();

};

var noteCards = document.querySelectorAll('.note-card');

function addTimer(noteCard) {
    var titleSpan = noteCard.querySelector('.note-title');
    var addButton = noteCard.querySelector('.new-list');
    var textAfterCheckboxes = noteCard.querySelectorAll('.text-after-checkbox');
    var checkboxes = noteCard.querySelectorAll('.form-check-input');
    var saveTimer;

    function startSaveTimer() {
        saveTimer = setTimeout(function () {
            
            var listItemElements = noteCard.querySelectorAll('.list-group-item:not(.inactive)');
            var listItems = [];

            listItemElements.forEach(function (listItem) {
                var span = listItem.querySelector('span');
                var item = span.textContent.trim();

                var isChecked;
                if (listItem.classList.contains('checked')) {
                    isChecked = 'false';
                } else {
                    isChecked = 'true';
                }

                listItems.push([item, isChecked]);
            });
            
            let id = noteCard.getAttribute('card-id');
            let title = titleSpan.textContent;
            let content = compileString(listItems);
            let isArchived = "false";
            
            
            
            let formData = new FormData();
            formData.append('id', id);
            formData.append('title', title);
            formData.append('content', content);
            formData.append('isArchived', isArchived);
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'updateNoteAction.php', true);
            xhr.onload = function () {
                
                noteCard.setAttribute("card-id", this.responseText );
                console.log("Saved note with ID: " + noteCard.getAttribute('card-id'));
            };
            
            xhr.send(formData);

            
        }, (secondsToSave * 1000)); 
    }

    function resetSaveTimer() {
        clearTimeout(saveTimer);
        startSaveTimer();
    }

    titleSpan.addEventListener('input', resetSaveTimer);
    addButton.addEventListener('click', resetSaveTimer);

    textAfterCheckboxes.forEach(function (span) {
        span.addEventListener('keyup', resetSaveTimer);
    });

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', resetSaveTimer);
    });

    if( noteCard.getAttribute('card-id') == '-1'){
        startSaveTimer();
    }
    
};

function compileString(val){
    var text = "";

    for (let i = 0; i < val.length; i++) {
        if (i === val.length - 1) {
          text += val[i][0] + ": " + val[i][1] + "";
        } else {
          text += val[i][0] + ": " + val[i][1] + " | ";
        }
      }
      

    return text;
}
