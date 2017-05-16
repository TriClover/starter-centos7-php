# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.box = "mls/web"
  config.vm.box_url = "http://mls-centos01/vagrantboxes/mls_web.json"
  config.vm.box_version = ">=2.0,<3.0"
  config.ssh.insert_key = false
  config.ssh.username = "vagrant"
  config.ssh.password = "mlsvagrant"
  
  # Web vhosts
  config.vm.network "forwarded_port", guest: 443, host: 8800
  config.vm.network "forwarded_port", guest: 80, host: 8801
  
  # MySQL
  config.vm.network "forwarded_port", guest: 3306, host: 3306
  
  # SSH (Port 22 -> 2222 is included by default, don't enable the same port here or you get duplicate error)
  #config.vm.network "forwarded_port", guest: 22, host: 2222

  # Show this after successful `vagrant up`
  config.vm.post_up_message = "See the Vagrantfile portforward section for accessible services and their passwords. If the localhost port forwarding isn't working, just use the IP address Vagrant listed as 'SSH address' near the beginning of this output to access the guest ports directly. *** For the site to actually work you will need to either import data into the internal mysql server, or point the site at an external mysql server. Other than that everything is ready to go, unless you also see some errors."
  
  # Share folders into the VM. By default the project root becomes /vagrant
  # This line also shares the actual website folder to where apache will look for the web root.
  config.vm.synced_folder "webroot", "/var/www/site1/webroot"
  config.vm.synced_folder "provision", "/var/www/site1/provision"
  config.vm.synced_folder "config", "/var/www/site1/config"

  # Install Ansible
  config.vm.provision "shell", inline: "yum -y install epel-release"
  config.vm.provision "shell", inline: "yum -y install ansible"
  
  # Run the ansible playbook to install software and run configurations
  # See this file for the root mysql password
  config.vm.provision :ansibleLocal, :playbook => "provision/playbook.yml"

end
