$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    function updateTableStatus(tableId) {
        $.ajax({
            type: 'GET', // Use GET request to fetch the latest status
            url: '/update/table/status/' + tableId, // Adjust the URL to your route
            success: function(response) {
                $('#table-status-' + tableId).text(response.status_tables)
            },
            error: function(error) {
                // Handle error if necessary
            }
        })
    }

    // Automatically update table status every 5 seconds
    $('.status-form').each(function() {
        var tableId = $(this).data('table-id')
        setInterval(function() {
            updateTableStatus(tableId)
        }, 2000) // 1 seconds
    })

    /*-------------------------------------------------------------------------*/
    function bindInputChange(inputId, outputId) {
        const selectedValue = $('#' + inputId).val();
        $('#' + outputId).text(selectedValue);
        return selectedValue; // Return the selected value
    }



    /*------------------------------------------------------------------------ */
    let currentPage = 1 // Track the current page
    const itemsPerPage = 2 // Number of items to display per page

    var inputValue;

    function updateTables() {
        $.ajax({
            type: 'GET',
            url: '/get-updated-tables',
            success: function(response) {
                // Assuming response.status_tables is an array of objects
                const totalTables = response.allTables.length
                const startIndex = (currentPage - 1) * itemsPerPage
                const endIndex = Math.min(startIndex + itemsPerPage, totalTables);

                let tableData = response.allTables
                    .slice(startIndex, endIndex)
                    .map(table => {
                        return `<!--<p>Table ID: ${table.table_id}, Name: ${table.status_tables}, ...</p>-->
                        <tr>
                            <td>${table.table_id}</td>
                            <td>
                            <p>${table.status_tables}</p>

                            <!--
                            <form class="status-form-Required" data-table-id-Required="${table.table_id}" action="/update/table/status/${table.table_id}" method="post">
                            @csrf
                            <label>
                                <input type="radio" name="status" value="1" ${table.status_tables == 1 ? 'checked' : ''}>
                                ยกเลิก
                            </label>
                            <label>
                                <input type="radio" name="status" value="2" ${table.status_tables == 2 ? 'checked' : ''}>
                                ว่าง
                            </label>
                            <label>
                                <input type="radio" name="status" value="3" ${table.status_tables == 3 ? 'checked' : ''}>
                                ไม่ว่าง
                            </label>
                            <button type="submit">Submit</button>
                        </form>-->
                        <form class="status-form-Required" data-table-id="${table.table_id}" action="/update/table/status/${table.table_id}" method="post">
                            @csrf
                            <label>
                                <input type="radio" name="status" value="1" ${table.status_tables === 1 ? 'checked' : ''}>
                                ยกเลิก
                            </label>
                            <label>
                                <input type="radio" name="status" value="2" ${table.status_tables === 2 ? 'checked' : ''}>
                                ว่าง
                            </label>
                            <label>
                                <input type="radio" name="status" value="3" ${table.status_tables === 3 ? 'checked' : ''}>
                                ไม่ว่าง
                            </label>
                            <button type="submit">Submit</button>
                        </form>

                    </td>


            </td>

                        </tr>`
                    })

                $('#table-all').html(tableData.join('')) // Update the content

                const totalPages = Math.ceil(totalTables / itemsPerPage)
                if (totalPages > 1) {
                    $('#pagination').empty() // Clear pagination links
                    for (let i = 1; i <= totalPages; i++) {
                        $('#pagination').append(
                            `<button class="page-btn" data-page="${i}">${i}</button>`
                        )
                    }
                }
            },
            error: function(error) {
                // Handle error if necessary
            }
        })
    }

    // $(document).on('submit', '.status-form-Required', function (event) {
    //     event.preventDefault();

    //     const form = $(this);
    // const tableId = form.attr('data-table-id-Required'); // Corrected line
    // const formData = form.serialize();

    // console.log('form:', form);
    // console.log('tableId:', tableId);
    // console.log('formData:', formData);
    //     if (!formData) {
    //         alert('กรุณาเลือกสถานะก่อน')
    //         return // Stop further processing
    //     }

    //     var confirmation = confirm('คุณแน่ต้องการเปลี่ยนสถานะโต๊ะใช่หรือไม่')
    //     if (confirmation) {
    //         // Execute actions when the user confirms
    //         $.ajax({
    //             type: 'POST',
    //             url: form.attr('action'),
    //             data: formData,
    //             success: function (response) {
    //                 // Update the content dynamically if needed
    //                 // You can add your own logic here
    //             },
    //             error: function (error) {
    //                 // Handle error if necessary
    //             }
    //         })
    //     }
    //     //window.location.href = `/edit-table/${tableId}`;
    // });

    function updateTablesInput(selectedValue) {
        $.ajax({
            type: 'GET',
            url: '/get-updated-tables/' + inputValue + ',' + selectedValue,
            success: function(response) {
                /*
                // Assuming response.status_tables is an array of objects
                const table = response.allTables;
                let tableData = '';

                if (!response.allTables) {
                    tableData = `
                    <tr>
                        <td colspan="2">
                            <p>No data</p>
                        </td>
                    </tr>`;
                } else {
                    tableData = `
                    <tr>
                        <td>${table.table_id}</td>
                        <td>
                            <p>${table.status_tables}</p>
                        </td>
                    </tr>`;
                }
                $('#table-all').html(tableData); // Update the content

                $('#pagination').empty(); // Clear pagination links
                */
                // Assuming response.status_tables is an array of objects
                const totalTables = response.allTables.length
                const startIndex = (currentPage - 1) * itemsPerPage
                const endIndex = Math.min(startIndex + itemsPerPage, totalTables);


                let tableData = '';
                if (totalTables === 0) {
                    tableData = `
                    <tr>
                        <td colspan="2">
                            <p>No data</p>
                        </td>
                    </tr>`;
                } else {
                    tableData = response.allTables
                        .slice(startIndex, endIndex)
                        .map(table => {
                            return `
                            <tr>
                                <td>${table.table_id}</td>
                                <td>
                                    <p>${table.status_tables}</p>
                                </td>
                            </tr>`;
                        })
                        .join('');
                }

                $('#table-all').html(tableData); // Update the content
                const totalPages = Math.ceil(totalTables / itemsPerPage)
                $('#pagination').empty();
                if (totalPages > 1) {
                    $('#pagination').empty() // Clear pagination links
                    for (let i = 1; i <= totalPages; i++) {
                        $('#pagination').append(
                            `<button class="page-btn" data-page="${i}">${i}</button>`
                        )
                    }
                }
            },
            error: function(error) {
                // Handle error if necessary
            }
        })
    }

    // Handle page navigation
    $(document).on('click', '.page-btn', function() {
        currentPage = parseInt($(this).data('page'))
        //updateTables()
    })

    updateTables()

    setInterval(function() {
        const selectedValue1 = bindInputChange('input1', 'output1');
        $('#selectedValue1').text(selectedValue1);
        if (inputValue == null || inputValue === '') {
            updateTables()
        } else {
            updateTablesInput(selectedValue1)
        }
    }, 3000) // 10 seconds
    /*------------------------------------------------------------------------ */

    $('#searchInput').on('keyup', function() {
        // Get the input value
        inputValue = $(this).val();
        if (/^\/+$/.test(inputValue)) {
            inputValue = 'null';
        }
        if (inputValue == null || inputValue == '') {
            $('#outputSearch').text('no input');
        } else {
            $('#outputSearch').text(inputValue);
        }

    });

    /*------------------------------------------------------------------------ */

    $('.status-form').submit(function(event) {
        event.preventDefault()

        var form = $(this)
        var tableId = form.data('table-id')
        var formData = form.serialize()
        //console.log('form' + form + ' |tableId' + tableId + ' |formData' + formData);
        console.log('form:', form);
        console.log('tableId:', tableId);
        console.log('formData:', formData);
        // Check if any radio button is selected
        if (!$('input[name="status"]:checked').val()) {
            alert('กรุณาเลือกสถานะก่อน')
            return // Stop further processing
        }

        // // Display a confirmation dialog
        var confirmation = confirm('คุณแน่ต้องการเปลี่ยนสถานะโต๊ะใช่หรือไม่')
        if (confirmation) {
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                success: function(response) {
                    // Update the content dynamically if needed
                    // You can add your own logic here
                    $('#table-status-' + tableId).text(response.status_tables)
                },
                error: function(error) {
                    // Handle error if necessary
                }
            })
        }
    });

    $(document).on('submit', '.status-form-Required', function(event) {
        event.preventDefault();

        var form = $(this);

        var tableId = form.data('table-id-Required');
        var formData = form.serialize();
        /*            //console.log('form' + form + ' |tableId' + tableId + ' |formData' + formData);
                    console.log('form:', form);
                    console.log('tableId:', tableId);
                    console.log('formData:', formData);
        */
        // Check if any radio button is selected
        if (!$('input[name="status"]:checked', form).val()) {
            alert('กรุณาเลือกสถานะก่อน');
            return; // Stop further processing
        }

        // Display a confirmation dialog
        var confirmation = confirm('คุณแน่ต้องการเปลี่ยนสถานะโต๊ะใช่หรือไม่');
        if (confirmation) {
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                success: function(response) {
                    // Update the content dynamically if needed
                    // You can add your own logic here
                    // $('#table-status-' + tableId).text(response.status_tables)
                },
                error: function(error) {
                    // Handle error if necessary
                }
            });
        }
    });


})
