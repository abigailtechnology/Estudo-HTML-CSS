<Drawer onClose={onCloseUserSelect} isOpen={isOpenUserSelect} size={'full'}>
<DrawerOverlay />
<DrawerContent
  background={
    // 'radial-gradient(ellipse at center,  #8825fc 0%,#5e00cd 100%)'

    'linear-gradient(to bottom, #763DF2 30%, #F2F2F2 10% ,#F2F2F2 60%)'
  }
>
  {/* <DrawerCloseButton /> */}
  <DrawerHeader>{``}</DrawerHeader>
  <Container maxW="6xl" centerContent height={'full'} color={'purple'}>
    <DrawerBody>
      <Box>
        <VStack>
          <HStack color="white" fontWeight={'bold'} fontSize={36}>
            <Text>Esse Login possui mais de uma Matrícula</Text>
          </HStack>
          <HStack color="white" fontWeight={'bold'} fontSize={24}>
            <Text>Selecione abaixo a matrícula desejada</Text>
          </HStack>
        </VStack>
        <Spacer h={10} />
<ModaL>
        <AsyncSelect
          _background={'red'}
          closeMenuOnSelect={true}
          loadOptions={loadOptionsIdentification}
          defaultOptions
          placeholder="Selecione a matrícula"
          // noOptionsMessage={() => 'Nenhum perfil encontrado'}

          onChange={val => val.value && setUserIdentification(val.value)}
        />
        <Spacer h={10} />
        <VStack spacing={15}>
          <Button
          
            size="lg"
            width={'254px'}
            aria-label="Selecionar a matrícula"
            variant="solid"
            colorScheme="purple"
            onClick={() => handleSetIdentification(userInfo)}
          >
            Selecionar
          </Button>
          <Button
            size="lg"
            width={'254px'}
            aria-label="Selecionar a matrícula"
            variant="solid"
            onClick={logout}
            colorScheme="red"
          >
            Sair
          </Button>
        </VStack>
      </Box>
    </DrawerBody>
    </Modal>
  </Container>
</DrawerContent>
</Drawer>