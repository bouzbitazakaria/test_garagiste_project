<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  document.getElementById('searchInput').addEventListener('input', function() {
      const query = this.value;
      axios.get(`/api/clients/search?query=${query}`)
          .then(response => {
              const clients = response.data;
              let html = '';
              
              if (clients.length > 0) {
                  clients.forEach(client => {
                      html += `
                          <tr>
                              <td>
                                  <div class="d-flex px-2 py-1">
                                      <div class="d-flex flex-column justify-content-center">
                                          <h6 class="mb-0 text-sm">${client.firstName}</h6>
                                      </div>
                                  </div>
                              </td>
                              <td>
                                  <p class="text-xs text-secondary mb-0">${client.lastName}</p>
                              </td>
                              <td class="align-middle text-center text-sm">
                                  <p class="text-xs text-secondary mb-0">${client.address}</p>
                              </td>
                              <td class="align-middle text-center">
                                  <span class="text-secondary text-xs font-weight-bold">${client.phoneNumber}</span>
                              </td>
                              <td class="align-end text-end text-sm px-1">
                                  <button type="button" class="btn btn-outline-info btn-sm m-0" data-bs-toggle="modal" data-bs-target="#editModal-${client.id}">Edit</button>
                                  <button type="button" class="btn btn-outline-danger btn-sm m-0" data-bs-toggle="modal" data-bs-target="#removeModal-${client.id}">Remove</button>
                                  <button type="button" class="btn btn-outline-dark btn-sm m-0" data-bs-toggle="modal" data-bs-target="#vehiclesModal-${client.id}">Vehicles</button>
                              </td>
                          </tr>`;
                  });
              } else {
                  html = `
                      <tr>
                          <td colspan="5" class="text-center">No clients found</td>
                      </tr>`;
              }
              document.getElementById('searchResults').innerHTML = html;
          })
          .catch(error => {
              console.error('There was an error fetching the search results!', error);
          });
  });
</script>
