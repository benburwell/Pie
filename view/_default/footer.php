<?php

################################################################################
##                                                                            ##
##  Copyright 2012 Ben Burwell                                                ##
##                                                                            ##
##  Licensed under the Apache License, Version 2.0 (the "License");           ##
##  you may not use this file except in compliance with the License.          ##
##  You may obtain a copy of the License at                                   ##
##                                                                            ##
##  http://www.apache.org/licenses/LICENSE-2.0                                ##
##                                                                            ##
##  Unless required by applicable law or agreed to in writing, software       ##
##  distributed under the License is distributed on an "AS IS" BASIS,         ##
##  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.  ##
##  See the License for the specific language governing permissions and       ##
##  limitations under the License.                                            ##
##                                                                            ##
################################################################################

?>
			</article>
		</div>
		<footer>
			<nav id="account">
				<?php if ($this->session->loggedIn()): ?>
					<a href="<?php echo WEBROOT; ?>logout">Logout</a>
				<?php else: ?>
					<a href="<?php echo WEBROOT; ?>login">Login</a>
				<?php endif; ?>
			</nav>
			<p>Copyright &copy; <?php echo date('Y'); ?> - Proudly Powered by <a href="http://pie.benburwell.com/">Pie</a> v. <?php echo PIE_VERSION; ?></p>
		</footer>
		<script type="text/javascript">
		<?php
			foreach ($this->session->getMessages() as $message) {
				echo 'alert("'.addslashes($message).'");';
			}
		?>
		</script>
	</body>
</html>