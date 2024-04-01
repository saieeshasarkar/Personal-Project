<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Treeview Dropdown With Search</title>
<style>
  .treeview {
    position: relative;
    display: inline-block;
    width: 200px;
  }

  .treeview-input {
    width: 100%;
    padding: 5px;
    box-sizing: border-box;
  }

  .treeview ul {
    list-style: none;
    padding: 0;
    margin: 5px 0;
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    z-index: 1;
    display: none;
  }

  .treeview ul.open {
    display: block;
  }

  .treeview li {
    padding: 5px;
    cursor: pointer;
  }

  .treeview li:hover {
    background-color: #f0f0f0;
  }
</style>
</head>
<body>

<div class="treeview">
  <input type="text" class="treeview-input" placeholder="Search...">
  <ul>
    <li>Parent 1
      <ul>
        <li>Child 1</li>
        <li>Child 2</li>
      </ul>
    </li>
    <li>Parent 2
      <ul>
        <li>Child 3</li>
        <li>Child 4</li>
      </ul>
    </li>
  </ul>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var treeviewInputs = document.querySelectorAll('.treeview-input');

    treeviewInputs.forEach(function(input) {
      input.addEventListener('input', function() {
        var searchTerm = this.value.toLowerCase();
        var treeview = this.closest('.treeview');
        var treeviewItems = treeview.querySelectorAll('li');

        treeviewItems.forEach(function(item) {
          var text = item.textContent.toLowerCase();
          if (text.includes(searchTerm)) {
            item.style.display = 'block';
            // If the parent is a child of another list, show its parent as well
            if (item.parentElement.tagName.toLowerCase() === 'ul') {
              item.parentElement.style.display = 'block';
              item.parentElement.parentElement.style.display = 'block';
            }
          } else {
            item.style.display = 'none';
          }
        });

        // Open the treeview dropdown
        treeview.querySelector('ul').classList.add('open');
      });

      input.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent closing the dropdown on input click
      });

      // Close the treeview dropdown on document click
      document.addEventListener('click', function() {
        var openDropdowns = document.querySelectorAll('.treeview ul.open');
        openDropdowns.forEach(function(dropdown) {
          dropdown.classList.remove('open');
        });
      });
    });
  });
</script>

</body>
</html>
