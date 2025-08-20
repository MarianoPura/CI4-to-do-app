document.addEventListener("DOMContentLoaded", function() {
    const taskList = document.querySelector('.tasksList');
    const registrationForm =  document.querySelector('#registrationForm');
    const loginForm = document.querySelector('#loginForm');
    const logout = document.querySelector('#logout');

    function loadTask (){
        fetch('to-do', {
            method: 'GET',
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        })
        .then(response => response.json())
        .then(data => {
            if(!data.success){
                alert(data.message);
                window.location.href = data.redirect;
            }
            taskList.innerHTML = '';
            data.tasks.forEach(task =>{
                const li = document.createElement("li");
                li.classList.add('task');
                if(task.status === 'complete'){
                    li.classList.toggle('complete')
                }
                const span = document.createElement("span");
                span.textContent = task.task;
                li.appendChild(span);
                const deleteBtn = document.createElement("button");
                deleteBtn.textContent = 'Delete';
                li.appendChild(deleteBtn);
                taskList.appendChild(li);

                li.addEventListener('click', e => {
                    fetch(`updateTask/${task.id}`, {
                        method: 'POST',
                        headers: {'X-Requested-With': 'XMLHttpRequest'}
                    })
                    .then(response => response.json())
                    .then(data =>{
                        if(data.success){
                            loadTask();
                        }
                        loadTask();
                    })
                })

                deleteBtn.addEventListener('click', e => {
                    e.stopPropagation();
                    if(confirm('Are you sure you want to remove this task?')){
                        fetch(`delete/${task.id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type': 'application/json',
                                'Accecpt': 'application/json'
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if(data.success){
                                    alert(data.message);
                                }
                                loadTask();
                        }).catch(err=>console.error(err))
                    }
                })
            })
        

        }).catch(err=>console.error(err));

         
    }


    

    if (registrationForm){
        registrationForm.addEventListener('submit', function(e){
            e.preventDefault();
            const form = {
            name: document.querySelector('#name').value,
            email: document.querySelector('#email').value,
            password: document.querySelector('#password').value,
            confirm: document.querySelector('#confirm').value
            }
            fetch('register', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(form)
            })
            .then (response => response.json())
            .then (data => {
                if (data.success){
                    alert(data.message);
                    window.location.href = data.redirect;
                }
                else{
                    if (data.redirect){
                        alert(data.message)
                        window.location.href = data.redirect;
                    }
                    else{
                        alert(JSON.stringify(data.message));
                    }
                }
            }).catch (err=> console.error(err));
        });
    }

    if(loginForm){
        loginForm.addEventListener('submit', function(e){
            e.preventDefault();
            const form ={
                email: document.querySelector('#email').value,
                password: document.querySelector('#password').value
            }

            fetch('login', {
                method:'POST',
                headers:{
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(form)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success){
                    alert(data.message);
                    window.location.href = data.redirect;
                }
                else {
                    alert(JSON.stringify(data.message));
                    if (data.redirect){
                        window.location.href = data.redirect;
                    }
                }
            }).catch(err=>console.error(err));
        })
    }


    logout.addEventListener('submit', function(e){
        e.preventDefault();
        fetch('logout', {
            method: 'POST',
            headers:{
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success){
                window.location.href = data.redirect;
            }
            else {
                alert(data.message)
                window.location.href = data.redirect;
            }
        }).catch(err=>console.error(err))
    })

loadTask();
    })