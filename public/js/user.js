$(async () => {

    // Preferences
    const pref = { tuplesPerPage: 5 }

    // STORAGE
    const user = {
        fname: '',
        lname: '',
        email: '',
        gender: '',
        address: '',
        list: [],
        search: [],
    }

    // Ref table
    const tableBody = $('#table-body')

    // Ref pagination
    let activePage = 1
    const pagination = $('.pagination')
    const prev = pagination.find('.prev')
    const next = pagination.find('.next')
    
    // SET pagination
    const setPagination = (active) => {

        // Avoid overing haha
        const count = user.list.length
        const pages = Math.floor(count / pref.tuplesPerPage) + (count % pref.tuplesPerPage > 0 ? 1 : 0)
        active = Number(active)
        if (active < 1 || active > pages) return;

        // Get and remove current page items
        const currentPageItems = pagination.find('.page-item').not('.prev, .next')
        currentPageItems.remove()

        // Get only the tuples to display
        const start = pref.tuplesPerPage * (active - 1)
        const end = start + pref.tuplesPerPage
        const tuples = user.list.slice(start, end)

        // Craft page items
        let pageItems = ``

        // Add page items
        for (let i = 1; i <= pages; i++) {
            pageItems += `<li class="page-item ${active == i ? 'active' : ''}"><a class="page-link" href="#">${i}</a></li>`
        }

        // Set paginations
        prev.after(pageItems)

        // Empty user table first
        tableBody.html('')

        // Add user to table
        tuples.forEach(u => addUser(u))

        // Set States
        activePage = active

        if (activePage <= 1) prev.addClass('disabled')
        else prev.removeClass('disabled')
        
        if (activePage >= pages) next.addClass('disabled')
        else next.removeClass('disabled')
    }

    // PREV/NEXT page
    prev.click(() => setPagination(activePage - 1))
    next.click(() => setPagination(activePage + 1))

    // MOVE page
    pagination.click('.page-item', (e) => {
        const pi = $(e.target)
        if (!isNaN(pi.text())) setPagination(pi.text())
    })

    // APPEND user to table body
    const addUser = (user) => {

        // Craft row
        const row = `
            <tr class="user-item">
                <td class="align-content-center" name="id">${user?.id}</td>
                <td><input value="${user?.icas_first_name}" class="border-0 bg-transparent p-2" type="text" name="firstname" placeholder="Enter Firstname" required></td>
                <td><input value="${user?.icas_last_name}" class="border-0 bg-transparent p-2" type="text" name="lastname" placeholder="Enter Lastname" required></td>
                <td><input value="${user?.icas_email}" class="border-0 bg-transparent p-2" type="email" name="email" placeholder="Enter Email" required></td>
                <td><input value="${user?.icas_gender}" class="border-0 bg-transparent p-2" type="text" name="gender" placeholder="Enter Gender" required></td>
                <td><input value="${user?.icas_address}" class="border-0 bg-transparent p-2" type="text" name="address" placeholder="Enter Address" required></td>
                <td><button class="btn btn-danger">Delete</button></td>
            </tr>
        `

        // Not append it to table-body
        tableBody.append(row)

        // re-use
        return user
    }

    // GET and list all users
    $.get('/user', (data, status) => {
        
        // Stop on error
        if (status != 'success') return alert(`GET [${status}]: ${data}`);

        // Save
        user.list = data

        // Get pages to show
        setPagination(1)
    })

    // CREATE a user through request
    const userForm = $('#user-form')
    userForm.on('submit', async (e) => {
        
        // Avoid reload
        e.preventDefault()
        
        // Get data
        const formData = new FormData(e.target)
        const formObject = Object.fromEntries(formData.entries());

        // POST it myself
        $.post('/user', formObject, (data, status) => {

            // Stop on error
            if (status != 'success') return alert(`POST [${status}]: ${data}`);
            
            // Add to user list
            user.list.push(data)
            
            // Add to DOM
            addUser(data)
            e.target.reset()
        })
    })

    // UPDATE a user on change
    tableBody.on('change', '.user-item', async (e) => {

        // Ref user-item
        const userItem = $(e.target).closest('.user-item')

        // Get Data
        const data = {
            id: userItem.find('td[name="id"]').text(),
            firstname: userItem.find('input[name="firstname"]').val(),
            lastname: userItem.find('input[name="lastname"]').val(),
            email: userItem.find('input[name="email"]').val(),
            gender: userItem.find('input[name="gender"]').val(),
            address: userItem.find('input[name="address"]').val(),
        }

        // PATCH it
        await fetch('/user', { method: 'PATCH', body: JSON.stringify(data) })
            .then(res => res.text())
            .then(data => console.log(data))
            .catch(err => console.log(err))
    })

    // DELETE a user on click delete
    tableBody.on('click', '.user-item .btn-danger', async (e) => {

        // Ref user-item
        const userItem = $(e.target).closest('.user-item')

        // Get data
        const data = { id: userItem.find('td[name="id"]').text() }

        // DELETE it
        await fetch('/user', { method: 'DELETE', body: JSON.stringify(data) })
            .then(res => res.text())
            .then(data => console.log(data))
            .then(() => userItem.remove())
            .then(() => user.list = user.list.filter(u => u.id != data.id))
            .catch(err => console.log(err))
            .finally(() => setPagination(activePage))
    })

    // SEARCH Functionality
    const searchForm = $('#search-form')

    // SEARCH func
    const searchUser = async (search) => {
        
        // Get Search Data
        $.get(`/user/${search}`, (data, status) => {

            // Stop on error
            if (status != 'success') return alert(`POST [${status}]: ${data}`);

            // Update search list
            user.search = JSON.parse(data)

            // Empty table first
            tableBody.html('')

            // Add searched to table
            user.search.forEach(u => addUser(u))
        })

    }

    // SEARCH on submit
    searchForm.on('submit', async (e) => {

        // Don't reload
        e.preventDefault()

        // Get data
        const search = $(e.target).find('input[name="search"]').val()
        if (search) return await searchUser(search)
        
        // Reset content to user list
        setPagination(activePage)
    })

    // SEARCH on input
    searchForm.on('input', 'input[name="search"]', async (e) => {

        // Get data
        const search = e.target.value
        if (search) return await searchUser(search)
        
        // Reset content to user list
        setPagination(activePage)
    })


})