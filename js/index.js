const queryString = document.getElementById("queryString");
const searchType = document.getElementById("searchByValue");
const btnSearch = document.getElementById("searchDocuments");

btnSearch.onclick = (ev) => searchDocuments(ev);

function searchDocuments(ev)
{
    const formData = new FormData();
    formData.append("query",queryString.value);
    formData.append("typeOfSearch",searchType.value);
    formData.append("singleFiledSearch","yes");
   
     
    const fetchData =
    {
        method:"POST",
        body: formData
    }
    fetch("../php/index.php",fetchData)
        .then(response =>
        {
            if(!response.ok)
                throw new Error(response.statusText);
            else
                return response.json();

        }).then((result) => showAsTable(result))
    
        .catch(error => console.log(error));
}

function showAsTable(result)
{
    if (typeof Storage !== "undefined") 
    { 
        sessionStorage.setItem("result", JSON.stringify(result));
    }
    window.location="table.html";
}
