<?php include_once __DIR__ . '/../Layout/Header.php';

if (isset($_GET['search']) && !empty($_GET['search'])) {
	$users = App\Models\User::search($_GET['search']);
} else {
	$users = App\Models\User::all();
}

?>

<div class="container my-5">

	<div class="row">
		<h1 class="col-8">Users</h1>

		<div class="col-4">
			<form action="/admin" style="float: right;">
				<input type="text" name="search" placeholder="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">

				<input type="submit" value="Search">
			</form>
		</div>
	</div>

	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Username</th>
				<th scope="col">Email</th>
				<th scope="col">Admin</th>
				<th scope="col">Last Login</th>
				<th scope="col">Updated At</th>
				<th scope="col">Created At</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users as $item) { ?>
				<tr>
					<th scope="row"><?php echo $item->id ?></th>
					<td><?php echo $item->username ?></td>
					<td><?php echo $item->email ?></td>
					<td><?php echo $item->admin ? 'Yes' : 'No' ?></td>
					<td><?php echo $item->last_login ?></td>
					<td><?php echo $item->updated_at ?></td>
					<td><?php echo $item->created_at ?></td>
					<td>
						<a href="/admin/edit/<?php echo $item->id ?>">Edit</a>
						<a href="/admin/delete/<?php echo $item->id ?>">Delete</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php include_once __DIR__ . '/../Layout/Footer.php' ?>