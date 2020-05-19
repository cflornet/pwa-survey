(
	function()
	{
		//get elements
		const username = document.getElementById('username');
		const password = document.getElementById('password');
		const btnLogin = document.getElementById('btnLogin');
		
		// add login event
		btnLogin.addEventListener
		(
			'click', e => 
			{
					// Get email and pwd
					const email = txtEmail.value;
					const pass = txtPassword.value;
					const auth = auth();
					
					// sign in
					const promise = auth.signInWithEmailAndPassword(email,pass);
					promise.catch(e => console.log(e.message));
			}
		);
		
		auth()
		(
			firebaseUser => 
			{
				container1 = document.getElementById('cnt_1');
				container2 = document.getElementById('cnt_2');
				if(firebaseUser)
				{
					container1.style.display = 'block';
					container2.style.display = 'none';
				}
				else
				{
					container1.style.display = 'none';
					container2.style.display = 'block';
				}	
			}
		)
	}()
);