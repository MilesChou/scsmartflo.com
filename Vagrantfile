Vagrant.configure(2) do |config|
  config.vm.define :app do |web_config|
    web_config.vm.box = "ubuntu/trusty64"
    web_config.vm.host_name = "web"
    web_config.vm.synced_folder ".", "/vagrant", type: "nfs"
    web_config.vm.synced_folder ".", "/var/www/html/", type: "nfs"
    web_config.vm.network "private_network", ip: "10.10.10.10"
    web_config.vm.provision "shell", path: "scripts/install.sh"

    web_config.vm.provider "virtualbox" do |v|
      v.memory = 1024
    end
  end
end
